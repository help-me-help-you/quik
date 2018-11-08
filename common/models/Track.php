<?php
namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * ads model
 *
 * @property integer $id
 * @property string $agent
 * @property string $ref
 * @property string $ip
 * @property string $system
 * @property string $city
 * @property string $country
 * @property string $page_view
 */
class Track extends ActiveRecord
{


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%track}}';
    }

    /**
     * @inheritdoc
     */

    public static function getCounty($ip_address)
    {
        //$ip_address= $_SERVER['REMOTE_ADDR'];

        $geopluginURL='http://www.geoplugin.net/php.gp?ip='.$ip_address;
        $addrDetailsArr = unserialize(file_get_contents($geopluginURL));

        $country = $addrDetailsArr['geoplugin_countryName'];



        if(!$country)
        {
            return $country='Not Define';
        }else
        {
            return $country;
        }

    }
    public static function getCity($ip_address)
    {
        //$ip_address= $_SERVER['REMOTE_ADDR'];

        //$geopluginURL='http://www.geoplugin.net/php.gp?ip='.$ip_address;
        $geopluginURL='http://www.geoplugin.net/php.gp';
        $addrDetailsArr = unserialize(file_get_contents($geopluginURL));
        $city = $addrDetailsArr['geoplugin_city'];

        if(!$city)
        {
            return  $city='Not Define';
        }
        else
        {
            return $city;
        }

    }

    public static function  track($agent,$remoteadr,$refer)
    {
        $track = new Track();
        //$_SERVER['HTTP_CLIENT_IP']
        // $_SERVER['HTTP_USER_AGENT'],  $_SERVER['REMOTE_ADDR'], $_SERVER['HTTP_REFERER']
        $track->agent = $agent;
        $track->ip= isset($remoteadr) ?$remoteadr : '';
        $track->system = gethostbyaddr($remoteadr);
        $track->ref=isset($refer) ?$refer : '';
        $track->page_view = "0";
        $track->city= Track::getCity($remoteadr);
        $track->country= Track::getCounty($remoteadr);

        $track->save(false);
    }

    public static function ExactBrowserName($ExactBrowserNameUA)
    {


        if (strpos(strtolower($ExactBrowserNameUA), "safari/") and strpos(strtolower($ExactBrowserNameUA), "opr/")) {
            // OPERA
            $ExactBrowserNameBR="Opera";
        } elseIf (strpos(strtolower($ExactBrowserNameUA), "safari/") and strpos(strtolower($ExactBrowserNameUA), "chrome/")) {
            // CHROME
            $ExactBrowserNameBR="Chrome";
        } elseIf (strpos(strtolower($ExactBrowserNameUA), "msie")) {
            // INTERNET EXPLORER
            $ExactBrowserNameBR="Internet Explorer";
        } elseIf (strpos(strtolower($ExactBrowserNameUA), "firefox/")) {
            // FIREFOX
            $ExactBrowserNameBR="Firefox";
        } elseIf (strpos(strtolower($ExactBrowserNameUA), "safari/") and strpos(strtolower($ExactBrowserNameUA), "opr/")==false and strpos(strtolower($ExactBrowserNameUA), "chrome/")==false) {
            // SAFARI
            $ExactBrowserNameBR="Safari";
        } else {
            // OUT OF DATA
            $ExactBrowserNameBR="OUT OF DATA";
        };

        return $ExactBrowserNameBR;
    }

    public static function ExactOs($ExactBrowserNameUA)
    {
        //return $ExactBrowserNameUA;
        $OSList = array
        (
// Match user agent string with operating systems
            'Windows 3.11' => 'Win16',
            'Windows 95' => '(Windows 95)|(Win95)|(Windows_95)',
            'Windows 98' => '(Windows 98)|(Win98)',
            'Windows 2000' => '(Windows NT 5.0)|(Windows 2000)',
            'Windows XP' => '(Windows NT 5.1)|(Windows XP)',
            'Windows Server 2003' => '(Windows NT 5.2)',
            'Windows Vista' => '(Windows NT 6.0)',
            'Windows 7' => '(Windows NT 7.0)',
            'Windows NT 4.0' => '(Windows NT 4.0)|(WinNT4.0)|(WinNT)|(Windows NT)',
            'Windows ME' => 'Windows ME',
            'Open BSD' => 'OpenBSD',
            'Sun OS' => 'SunOS',
            'Linux' => '(Linux)|(X11)',
            'Mac OS' => '(Mac_PowerPC)|(Macintosh)',
            'QNX' => 'QNX',
            'BeOS' => 'BeOS',
            'OS/2' => 'OS/2',
            'Search Bot'=>'(nuhk)|(Googlebot)|(Yammybot)|(Openbot)|(Slurp)|(MSNBot)|(Ask Jeeves/Teoma)|(ia_archiver)'
        );
// Loop through the array of user agents and matching operating systems
        foreach($OSList as $CurrOS=>$Match)
        {
// Find a match
            $patern = "/".$Match."/";
            if (preg_match($patern, $ExactBrowserNameUA))
            {
                break;
            }
        }
// You are using ...
        return $CurrOS;
    }
    public static function getLocationInfoByIp(){
        $client  = @$_SERVER['HTTP_CLIENT_IP'];
        $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
        $remote  = @$_SERVER['REMOTE_ADDR'];
        $result  = array('country'=>'', 'city'=>'');
        if(filter_var($client, FILTER_VALIDATE_IP)){
            $ip = $client;
        }elseif(filter_var($forward, FILTER_VALIDATE_IP)){
            $ip = $forward;
        }else{
            $ip = $remote;
        }
        $ip_data = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=".$ip));
        if($ip_data && $ip_data->geoplugin_countryName != null){
            $result['code'] = $ip_data->geoplugin_countryCode;
            $result['country'] = $ip_data->geoplugin_countryName;
            $result['state'] = $ip_data->geoplugin_regionName;
            $result['city'] = $ip_data->geoplugin_city;
            $result['lat'] = $ip_data->geoplugin_latitude;
            $result['lng'] = $ip_data->geoplugin_longitude;
        }
        else
        {
            $result['code'] = "+91";
            $result['city'] = "jodhpur";
            $result['state'] = "rajasthan";
            $result['country'] = "india";
            $result['lat'] = "26.258900";
            $result['lng'] = "73.024300";
        }
        return $result;
    }



}
