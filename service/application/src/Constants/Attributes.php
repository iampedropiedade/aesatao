<?php

namespace Application\Constants;


/**
 * Class Attributes
 * @package Application\Constants
 */
class Attributes
{
    protected $em;

    // Website
    public const string WEBSITE_PHONE = 'website_phone';
    public const string WEBSITE_EMAIL = 'website_email';
    public const string WEBSITE_ADDRESS = 'website_address';
    public const string WEBSITE_NEWS_ARTICLE_THUMBNAIL = 'default_news_article_thumbnail';

    // Generic, navigation & banner
    public const string NAVBAR_STYLE = 'navbar_style';
    public const string EXCLUDE_NAV = 'exclude_nav';
    public const string MAIN_IMAGE = 'thumbnail';
    public const string HIDE_TITLE = 'hide_title';
    public const string HIDE_FOOTER = 'hide_footer';
    public const string PAGE_HEADING = 'page_heading';
    public const string PAGE_HEADING_DARK = 'page_heading_dark_color';
    public const string REDIRECT_TO_EXTERNAL_URL = 'redirect_to_external_url';
    public const string SLIDESHOW_IMAGES = 'slideshow_images';
    public const string TAGS = 'tags';
    public const string FILE_TAGS = 'file_tags';
    public const string GALLERY_IMAGES = 'gallery_images';
    public const string PAGE_FILES = 'page_files';
    public const string REDIRECT_TO_PAGE = 'redirect_to_page';
}
