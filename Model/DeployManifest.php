<?php
namespace Magecrafts\WebApp\Model;

use Magento\Framework\App\Filesystem\DirectoryList;

class DeployManifest
{

    public function __construct(
        \Magento\Framework\Filesystem $appFilesystem
    ) {
        $this->filesystem = $appFilesystem;

    }


    public function deploy($areaCode, $themePath, $localeCode)
    {

        $config = [
            "name" => "Magecrafts",
            "short_name" => "Hbwsl",
            "start_url" => "https://mage.dev",
            "description" => "Making ecommerce fast",
            "display" => "standalone",
            "background_color" => "#3E4EB8",
            "theme_color" => "#2F3BA2",
            "icons"=> [[
                "src"=> "https://mage.dev/static/images/favicon/favicon.png",
                "sizes"=> "128x128",
                "type"=> "image/png"
            ],[
                "src"=> "https://mage.dev/static/images/favicon/apple-touch-icon.png",
                "sizes"=> "152x152",
                "type"=> "image/png"
            ], [
                "src"=> "https://mage.dev/static/images/favicon/mstile-144x144.png",
                "sizes"=> "144x144",
                "type=>" =>"image/png"
              ], [
                "src" => "https://mage.dev/static//images/favicon/android-chrome-192x192.png",
                "sizes"=> "192x192",
                "type"=> "image/png"
                ]
        ]
        ];

        $dir = $this->filesystem->getDirectoryWrite(DirectoryList::STATIC_VIEW);
        $relPath = 'manifest.json';
        if ($dir->isExist($relPath)) {
            $dir->writeFile($relPath, json_encode($config,JSON_PRETTY_PRINT));
        }

    }

}