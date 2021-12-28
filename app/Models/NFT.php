<?php

namespace App\Models;

use App\Services\QuerysDatabase\QueryInserter;
use Src\Repository\NFTRepository;
use Src\Helpers\MessageAuth;

class NFT
{

    public function addListNFT(int $user, int $nft): void
    {
        $launch = QueryInserter::schemaAddNFTtoList( (int) $user, (int) $nft );

        MessageAuth::launchMessage('success', 'Success!');
    }

    public function getListNFT(int $user): array
    {
        $response = NFTRepository::schemaFetchClientNFTs( (int) $user );
        return $response;
    }

    public function downloadFile($image): void
    {

        set_time_limit(0);

        $fileName = $image;
        $fileLocal = dirname(__DIR__, 2). '\storage\nfts\\' . $fileName;

        if(!file_exists($fileLocal)) return;
        
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$fileName");
        header("Content-Type: application/octet-stream");
        header("Content-Transfer-Encoding: binary");
        header('Content-Length: '.filesize($fileName));
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Pragma: public");
        header("Expires: 0");

        readfile($fileName);

    }

}

?>