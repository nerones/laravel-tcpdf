<?php namespace Xaoc\LaravelTcpdf;

use \TCPDF;
use Config;


class LaravelTcpdf extends TCPDF
{

    /**
     * TCPDF system constants that map to settings in our config file
     *
     * @var array
     */
    private $config_constant_map = [
        'K_PATH_CACHE'  => 'cache_directory',
        'K_PATH_IMAGES' => 'image_directory',
        'K_BLANK_IMAGE' => 'blank_image',
        'K_SMALL_RATIO' => 'small_font_ratio'
    ];



    /**
     * Constructor
     *
     * @author Markus Schober
     */
    public function __construct()
    {
        // Initialize TCPDF
        parent::__construct(
            config('laravel-tcpdf.page_orientation'),
            config('laravel-tcpdf.page_unit'),
            config('laravel-tcpdf.page_format'),
            config('laravel-tcpdf.unicode'),
            config('laravel-tcpdf.encoding'),
            config('laravel-tcpdf.enable_disk_cache')
        );

        // default margin settings
        $this->SetMargins(
            config('laravel-tcpdf.margin_left'),
            config('laravel-tcpdf.margin_top'),
            config('laravel-tcpdf.margin_right')
        );

        // default header setting
        $this->headerSettings();

        // default footer settings
        $this->footerSettings();

        // default page break settings
        $this->SetAutoPageBreak(
            config('laravel-tcpdf.page_break_auto'),
            config('laravel-tcpdf.footer_margin')
        );

        // default cell settings
        $this->cellSettings();

        // default document properties
        $this->setDocumentProperties();

        // default page font
        $this->setFont(
            config('laravel-tcpdf.page_font'),
            '',
            config('laravel-tcpdf.page_font_size')
        );

        // default image scale
        $this->setImageScale(config('laravel-tcpdf.image_scale'));
    }



    /**
     * Set all the necessary header settings
     *
     * @author Markus Schober
     */
    protected function headerSettings()
    {
        $this->setPrintHeader(
            config('laravel-tcpdf.header_on')
        );

        $this->setHeaderFont(array(
            config('laravel-tcpdf.header_font'),
            '',
            config('laravel-tcpdf.header_font_size')
        ));

        $this->setHeaderMargin(
            config('laravel-tcpdf.header_margin')
        );

        $this->SetHeaderData(
            config('laravel-tcpdf.header_logo'),
            config('laravel-tcpdf.header_logo_width'),
            config('laravel-tcpdf.header_title'),
            config('laravel-tcpdf.header_string')
        );
    }



    /**
     * Set all the necessary footer settings
     *
     * @author Markus Schober
     */
    protected function footerSettings()
    {
        $this->setPrintFooter(
            config('laravel-tcpdf.footer_on')
        );

        $this->setFooterFont(array(
            config('laravel-tcpdf.footer_font'),
            '',
            config('laravel-tcpdf.footer_font_size')
        ));

        $this->setFooterMargin(
            config('laravel-tcpdf.footer_margin')
        );
    }



    /**
     * Set the default cell settings
     *
     * @author Markus Schober
     */
    protected function cellSettings()
    {
        $this->SetCellPadding(
            config('laravel-tcpdf.cell_padding')
        );

        $this->setCellHeightRatio(
            config('laravel-tcpdf.cell_height_ratio')
        );
    }



    /**
     * Set default document properties
     *
     * @author Markus Schober
     */
    protected function setDocumentProperties()
    {
        $this->SetCreator(config('laravel-tcpdf.creator'));
        $this->SetAuthor(config('laravel-tcpdf.author'));
    }

}