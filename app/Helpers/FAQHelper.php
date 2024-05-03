<?php

namespace App\Helpers;

use App\Models\FAQ;

/**
 *
 */
class FAQHelper
{
    public function __construct(FAQ $faq)
    {
        $this->faq = $faq;
    }

    public function getAllFaqs()
    {
        $allFaqs = $this->faq->get();
        return $allFaqs;
    }
}