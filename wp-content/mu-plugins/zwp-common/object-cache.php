<?php
/*
  Name: Z.com WebHosting object cache
  Version: 1.0.0

  Install this file to wp-content/object-cache.php
 */
define('COMMAND_BASE_URL', 'https://wordpress-hosting.%s.cloud.z.com/');
define('COMMAND_CACHE_CLEAR_URL', COMMAND_BASE_URL . 'v1/cache/');

function wp_cache_add($key, $data, $group = '', $expire = 0)
{
    global $wp_object_cache;
    return $wp_object_cache->add($key, $data, $group, (int)$expire);
}

function wp_cache_close()
{
    return true;
}

function wp_cache_decr($key, $offset = 1, $group = '')
{
    global $wp_object_cache;

    return $wp_object_cache->decr($key, $offset, $group);
}

function wp_cache_delete($key, $group = '')
{
    global $wp_object_cache;

    return $wp_object_cache->delete($key, $group);
}

function wp_cache_flush()
{
    global $wp_object_cache;

    return $wp_object_cache->flush();
}

function wp_cache_get($key, $group = '', $force = false, &$found = null)
{
    global $wp_object_cache;

    return $wp_object_cache->get($key, $group, $force, $found);
}

function wp_cache_incr($key, $offset = 1, $group = '')
{
    global $wp_object_cache;

    return $wp_object_cache->incr($key, $offset, $group);
}

function wp_cache_init()
{
    $GLOBALS['wp_object_cache'] = new WP_Object_Cache();
    wp_using_ext_object_cache(false);
}

function wp_cache_replace($key, $data, $group = '', $expire = 0)
{
    global $wp_object_cache;

    return $wp_object_cache->replace($key, $data, $group, (int)$expire);
}

function wp_cache_set($key, $data, $group = '', $expire = 0)
{
    global $wp_object_cache;

    return $wp_object_cache->set($key, $data, $group, (int)$expire);
}

function wp_cache_switch_to_blog($blog_id)
{
    global $wp_object_cache;

    return $wp_object_cache->switch_to_blog($blog_id);
}

function wp_cache_add_global_groups($groups)
{
    global $wp_object_cache;

    return $wp_object_cache->add_global_groups($groups);
}

function wp_cache_add_non_persistent_groups($groups)
{
    return;
}

function wp_cache_reset()
{
    _deprecated_function(__FUNCTION__, '3.5');

    global $wp_object_cache;

    return $wp_object_cache->reset();
}

class WP_Object_Cache
{

    var $cache = array();
    var $cache_hits = 0;
    var $cache_misses = 0;
    var $global_groups = array();
    var $zwp_clear_group = array('posts', 'comment');
    var $blog_prefix;

    function add($key, $data, $group = 'default', $expire = 0)
    {
        if (wp_suspend_cache_addition()) {
            return false;
        }

        if (empty($group)) {
            $group = 'default';
        }

        $id = $key;
        if ($this->multisite && !isset($this->global_groups[$group])) {
            $id = $this->blog_prefix . $key;
        }

        if ($this->_exists($id, $group)) {
            return false;
        }

        return $this->set($key, $data, $group, (int)$expire);
    }

    function add_global_groups($groups)
    {
        $groups = (array)$groups;

        $groups = array_fill_keys($groups, true);
        $this->global_groups = array_merge($this->global_groups, $groups);
    }

    function decr($key, $offset = 1, $group = 'default')
    {
        if (empty($group)) {
            $group = 'default';
        }

        if ($this->multisite && !isset($this->global_groups[$group])) {
            $key = $this->blog_prefix . $key;
        }

        if (!$this->_exists($key, $group)) {
            return false;
        }

        if (!is_numeric($this->cache[$group][$key])) {
            $this->cache[$group][$key] = 0;
        }

        $offset = (int)$offset;

        $this->cache[$group][$key] -= $offset;

        if ($this->cache[$group][$key] < 0) {
            $this->cache[$group][$key] = 0;
        }

        return $this->cache[$group][$key];
    }

    function delete($key, $group = 'default', $deprecated = false)
    {
        if (empty($group)) {
            $group = 'default';
        }

        if (in_array($group, $this->zwp_clear_group)) {
            self::clear_zwp_cache();
        }

        if ($this->multisite && !isset($this->global_groups[$group])) {
            $key = $this->blog_prefix . $key;
        }

        if (!$this->_exists($key, $group)) {
            return false;
        }

        unset($this->cache[$group][$key]);
        return true;
    }

    function flush()
    {
        $this->cache = array();
        self::clear_zwp_cache();

        return true;
    }

    function get($key, $group = 'default', $force = false, &$found = null)
    {
        if (empty($group)) {
            $group = 'default';
        }

        if ($this->multisite && !isset($this->global_groups[$group])) {
            $key = $this->blog_prefix . $key;
        }

        if ($this->_exists($key, $group)) {
            $found = true;
            $this->cache_hits += 1;
            if (is_object($this->cache[$group][$key])) {
                return clone $this->cache[$group][$key];
            } else {
                return $this->cache[$group][$key];
            }
        }

        $found = false;
        $this->cache_misses += 1;
        return false;
    }

    function incr($key, $offset = 1, $group = 'default')
    {
        if (empty($group)) {
            $group = 'default';
        }

        if ($this->multisite && !isset($this->global_groups[$group])) {
            $key = $this->blog_prefix . $key;
        }

        if (!$this->_exists($key, $group)) {
            return false;
        }

        if (!is_numeric($this->cache[$group][$key])) {
            $this->cache[$group][$key] = 0;
        }

        $offset = (int)$offset;

        $this->cache[$group][$key] += $offset;

        if ($this->cache[$group][$key] < 0) {
            $this->cache[$group][$key] = 0;
        }

        return $this->cache[$group][$key];
    }

    function replace($key, $data, $group = 'default', $expire = 0)
    {
        if (empty($group)) {
            $group = 'default';
        }

        $id = $key;
        if ($this->multisite && !isset($this->global_groups[$group])) {
            $id = $this->blog_prefix . $key;
        }

        if (!$this->_exists($id, $group)) {
            return false;
        }

        return $this->set($key, $data, $group, (int)$expire);
    }

    function reset()
    {
        _deprecated_function(__FUNCTION__, '3.5', 'switch_to_blog()');

        // Clear out non-global caches since the blog ID has changed.
        foreach (array_keys($this->cache) as $group) {
            if (!isset($this->global_groups[$group])) {
                unset($this->cache[$group]);
            }
        }
    }

    function set($key, $data, $group = 'default', $expire = 0)
    {
        if (empty($group)) {
            $group = 'default';
        }

        if ($this->multisite && !isset($this->global_groups[$group])) {
            $key = $this->blog_prefix . $key;
        }

        if (is_object($data)) {
            $data = clone $data;
        }

        $this->cache[$group][$key] = $data;
        return true;
    }

    function stats()
    {
        echo "<p>";
        echo "<strong>Cache Hits:</strong> {$this->cache_hits}<br />";
        echo "<strong>Cache Misses:</strong> {$this->cache_misses}<br />";
        echo "</p>";
        echo '<ul>';
        foreach ($this->cache as $group => $cache) {
            echo "<li><strong>Group:</strong> $group - ( " . number_format(strlen(serialize($cache)) / 1024,
                    2) . 'k )</li>';
        }
        echo '</ul>';
    }

    function switch_to_blog($blog_id)
    {
        $blog_id = (int)$blog_id;
        $this->blog_prefix = $this->multisite ? $blog_id . ':' : '';
    }

    protected function _exists($key, $group)
    {
        return isset($this->cache[$group]) && (isset($this->cache[$group][$key]) || array_key_exists($key,
                    $this->cache[$group]));
    }

    function __construct()
    {
        global $blog_id;

        $this->multisite = is_multisite();
        $this->blog_prefix = $this->multisite ? $blog_id . ':' : '';


        /**
         * @todo This should be moved to the PHP4 style constructor, PHP5
         * already calls __destruct()
         */
        register_shutdown_function(array($this, '__destruct'));
    }

    function __destruct()
    {
        return true;
    }

    function clear_zwp_cache()
    {
        global $clear_cache_flg;
        if ($clear_cache_flg) {
            return false;
        }
        $clear_cache_flg = true;

        global $wpdb;
        $time = $wpdb->get_var($wpdb->prepare("SELECT meta_value FROM $wpdb->usermeta WHERE user_id = %d AND meta_key = %s;",
            0, 'wp_cache_clear_time'));
        if (empty($time)) {
            $wpdb->insert('wp_usermeta', array('user_id' => 0, 'meta_key' => 'wp_cache_clear_time', 'meta_value' => ''),
                array('%d', '%s', '%s'));
        }
        if ($time > strtotime('-1 min')) {
            return false;
        }
        $wpdb->update('wp_usermeta', array('meta_value' => strtotime("now")),
            array('user_id' => 0, 'meta_key' => 'wp_cache_clear_time'), array('%d'), array('%d', '%s'));

        $region = constant('ZWP_REGION_NAME');
        if ($region == null) {
            return false;
        }
        $token = md5(constant('DB_NAME'));
        $cc_url = sprintf(COMMAND_CACHE_CLEAR_URL, $region);
        $cc_url .= $token;
        self::exec_curl($cc_url);
    }

    function exec_curl($url)
    {

        $conn = curl_init();
        curl_setopt($conn, CURLOPT_CUSTOMREQUEST, 'DELETE');
        curl_setopt($conn, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($conn, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($conn, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($conn, CURLOPT_URL, $url);
        $response = curl_exec($conn);
        curl_close($conn);
        return true;
    }
}

?>
