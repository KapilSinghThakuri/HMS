<?php

namespace App\Helpers;

use App\Models\SiteInfoSettings;

/**
 *
 */
class WebsiteInfoHelper
{
    public function __construct(SiteInfoSettings $siteinfo)
    {
        $this->siteinfo = $siteinfo;
    }

    public function getSiteSocailMedia()
    {
        $socialMedias = $this->siteinfo->where('info_type','social_media')
            ->orderBy('display_order','asc')->get();
        return $socialMedias;
    }
    public function getSiteContact()
    {
        $contacts = $this->siteinfo->where('info_type','contact')
            ->orderBy('display_order','asc')->get();
        return $contacts;
    }

    public function getSiteAddress()
    {
        $address = $this->siteinfo->where('info_type','address')
            ->orderBy('display_order','asc')->get();
        return $address;
    }

    public function getGeneralInfo()
    {
        $generalInfo = $this->siteinfo->where('info_type','general_info')
            ->orderBy('display_order','asc')->get();
        return $generalInfo;
    }
}
