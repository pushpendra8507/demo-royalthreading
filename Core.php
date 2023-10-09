<?php
class Core extends Database
{
    public function __construct()
    {
        parent::__construct();
    }
    public function csrf_token()
    {
        $_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(32));
        $token = $_SESSION['token'];
        return $token;
    }
    public function verify_token($token_s)
    {
        if ($this->hash_equals1($_SESSION['token'], $token_s))
        {
            $token = 'yes';
            return $token;
        }
        else
        {
            $token = 'no';
            return $token;
        }
    }
    public function hash_equals1($str1, $str2)
    {
        if (strlen($str1) != strlen($str2))
        {
            return false;
        }
        else
        {
            $res = $str1 ^ $str2;
            $ret = 0;
            for ($i = strlen($res) - 1;$i >= 0;$i--)
            {
                $ret |= ord($res[$i]);
            }
            return !$ret;
        }
    }
    public function sanetize($string)
    {
        $string = str_replace('"', '', $string);
        $string = str_replace("'", '', $string);
        $string = htmlspecialchars($string);
        return $string;
    }
    public function custom_echo($x, $length)
    {
        if (strlen($x) <= $length)
        {
            return $x;
        }
        else
        {
            $y = substr($x, 0, $length) . '...';
            return $y;
        }
    }
    public function alias_url($string)
    {
        $string = str_replace(array(
            '[\', \']'
        ) , '', $string);
        $string = preg_replace('/\[.*\]/U', '', $string);
        $string = preg_replace('/&(amp;)?#?[a-z0-9]+;/i', '-', $string);
        $string = htmlentities($string, ENT_COMPAT, 'utf-8');
        $string = preg_replace('/&([a-z])(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig|quot|rsquo);/i',
        '\\1', $string);
        $string = preg_replace(array(
            '/[^a-z0-9]/i',
            '/[-]+/'
        ) , '-', $string);
        return strtolower(trim($string, '-'));
    }
    public function phone_url($string)
    {
        $string = str_replace(array(
            '[\', \']'
        ) , '', $string);
        $string = preg_replace('/\[.*\]/U', '', $string);
        $string = preg_replace('/&(amp;)?#?[a-z0-9]+;/i', '-', $string);
        $string = htmlentities($string, ENT_COMPAT, 'utf-8');
        $string = preg_replace('/&([a-z])(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig|quot|rsquo);/i',
        '\\1', $string);
        $string = preg_replace(array(
            '/[^a-z0-9]/i',
            '/[-]+/'
        ) , '', $string);
        return strtolower(trim($string, ''));
    }
    public function UploadImage($fname, $folder, $upname, $tbl, $field, $updatefield, $id)
    {
        $type = $fname["type"];
        $fname1 = $fname["name"];
        $path_info = pathinfo($fname1);
        $path_info['extension'];
        $ext = '.' . $path_info['extension'];
        if (($type = "image/jpg" || $type = "image/jpeg" || $type = "image/png" || $type = "image/bmp" || $type = "image/gif" || $type = "application/pdf" || $type = "application/msword"))
        {
            $pathv = $folder . $upname . $ext;
            $pathv = str_replace('../', '', $pathv);
            move_uploaded_file($fname["tmp_name"], $folder . $upname . $ext);
            $stmt = $this
                ->connection
                ->prepare("update $tbl set $field=? where $updatefield=?");
            $stmt->bindParam(1, $pathv);
            $stmt->bindParam(2, $id);
            $stmt->execute();
        }
    }
    public function set_sweetalert($data = array())
    {
        $_SESSION['SWEET_ALERT_STATUS'] = isset($data['status']) ? $data['status'] : '';
        $_SESSION['SWEET_ALERT_ICON'] = isset($data['icon']) ? $data['icon'] : '';
        $_SESSION['SWEET_ALERT_PAGEURL'] = isset($data['page_url']) ? $data['page_url'] : '';
    }
    public function make_url_seo_friendly($text_string)
    {
        $text_string = strtolower($text_string);
        return urlencode($text_string);
    }
    public function show_sweetalert()
    {
        if (isset($_SESSION['SWEET_ALERT_STATUS']))
        {
            $result = "<style>
      .swal-title:not(:first-child) {
        padding-bottom: 3rem !important;
      }
      .swal-icon{
        margin:10px auto !important;
      }
      </style>
      <script>swal({
        position: 'top-end',
        icon: '" . $_SESSION['SWEET_ALERT_ICON'] . "',
        title: '" . $_SESSION['SWEET_ALERT_STATUS'] . "',
        buttons: false,
        timer: 1000,
        });
        setTimeout(function() {
          document.location.href = '" . $_SESSION['SWEET_ALERT_PAGEURL'] . "';
        }, 1100);</script>";
            unset($_SESSION['SWEET_ALERT_STATUS']);
            unset($_SESSION['SWEET_ALERT_ICON']);
            unset($_SESSION['SWEET_ALERT_PAGEURL']);
            return $result;
        }
        else
        {
            return false;
        }
    }
    public function generate_secure_hash_token($text_string)
    {
        return md5(SECURITY_KEY . '::' . $text_string);
    }
    public function match_secure_hash_token($token, $text_string)
    {
        $match_status = 0;
        if ($token == md5(SECURITY_KEY . '::' . urlencode($text_string)))
        {
            $match_status = 1;
        }
        return $match_status;
    }
    public function get_current_url()
    {
        $link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        return $link;
    }
    public function get_sales_tax()
    {
        $stmt = $this
            ->connection
            ->prepare("select sales_tax from tbl_sales_tax where status = 1");
        $stmt->execute();
        $rtmt = $stmt->fetch();
        return $rtmt['sales_tax'];
    }
    public function filterName($field)
    {
        $field = filter_var(trim($field) , FILTER_SANITIZE_STRING);
        if (filter_var($field, FILTER_VALIDATE_REGEXP, array(
            "options" => array(
                "regexp" => "/^[a-zA-Z\s]+$/"
            )
        )))
        {
            return $field;
        }
        else
        {
            return false;
        }
    }
    public function filterEmail($field)
    {
        $field = filter_var(trim($field) , FILTER_SANITIZE_EMAIL);
        if (filter_var($field, FILTER_VALIDATE_EMAIL))
        {
            return $field;
        }
        else
        {
            return false;
        }
    }
    public function filterPhone($phone)
    {
        if (preg_match('/^\d{10}$/', $phone)) // phone number is valid
        {
            $phone = str_replace("-", "", $phone);
            if ($phone)
            {
                return $phone;
            }
            else
            {
                return false;
            }
        }
    }
    public function filterString($field)
    {
        $field = filter_var(trim($field) , FILTER_SANITIZE_STRING);
        if (!empty($field))
        {
            return $field;
        }
        else
        {
            return false;
        }
    }
    public function clean_url($string)
    {
        $string = str_replace(array(
            '[\', \']'
        ) , '', $string);
        $string = preg_replace('/\[.*\]/U', '', $string);
        $string = preg_replace('/&(amp;)?#?[a-z0-9]+;/i', '-', $string);
        $string = htmlentities($string, ENT_COMPAT, 'utf-8');
        $string = preg_replace('/&([a-z])(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig|quot|rsquo);/i', '\\1', $string);
        $string = preg_replace(array(
            '/[^a-z0-9]/i',
            '/[-]+/'
        ) , ' ', $string);
        return trim($string, '-');
    }

    
}
?>
