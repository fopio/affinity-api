<?php namespace Fopio\AffinityAPI\API;

/**
 * Class AffinityTaskAPI
 * @package App\Packages\Affinity
 */
class AffinityDocumentAPI extends AffinityAPICore
{
    /**
     * add document to site
     * @param $task_id
     * @return object
     */
    protected function addDocumentToSite($site_id)
    {
       $response = $this->client->CreateNewDocument(array('IdentityToken' => $this->getToken(),
            'Category' => 'Test',
            'Connection' => array(
                'ConnectionType' => 'Site',
                'ConnectionKeyType' => 'ID',
                'ConnectionKeyReference' => $site_id
            ),
            'FileName' => 'TestSamDoc.txt',
            'Length' => 343434,
            'SubCategory' => 'SubCat Test',
            'Summary' => 'this is a test',
            'UserName' => 'Sambo',
            'FileByteStream' => base64_encode('gfsdgdfgdfgd')
        ));

       /* $response = $this->client->CreateNewDocument(new \SoapVar('<ns1:CreateNewDocument>', XSD_ANYXML),
            new \SoapVar('<ns1:IdentityToken>' . $this->getToken() . '</ns1:IdentityToken>', XSD_ANYXML),
            new \SoapVar('</ns1:CreateNewDocument>', XSD_ANYXML));
*/

        dd($this->client->__getLastRequest(), $this->client->__getLastResponse());

        dd($response);
    }


    protected function AddDocument()
    {
        $category = 'random category';

        $connection = 'site';

        $filename = 'test.txt';

        $length = 3334343;

        $sub_category = 'sub cat';

        $summary = 'this is the summary';

        $username = 'samusername';

        $response = $this->client->CreateNewDocument(new \SoapVar('<ns1:CreateNewDocument>', XSD_ANYXML),
            new \SoapVar('<ns1:Category>' . $category . '</ns1:Category>', XSD_ANYXML),
            new \SoapVar('<ns1:Connection>' . $connection . '</ns1:Connection>', XSD_ANYXML),
            new \SoapVar('<ns1:FileName>' . $filename . '</ns1:FileName>', XSD_ANYXML),
            new \SoapVar('<ns1:IdentityToken>' . $this->getToken() . '</ns1:IdentityToken>', XSD_ANYXML),
            new \SoapVar('<ns1:Length>' . $length . '</ns1:Length>', XSD_ANYXML),
            new \SoapVar('<ns1:SubCategory>' . $sub_category . '</ns1:SubCategory>', XSD_ANYXML),
            new \SoapVar('<ns1:Summary>' . $summary . '</ns1:Summary>', XSD_ANYXML),
            new \SoapVar('<ns1:UserName>' . $username . '</ns1:UserName>', XSD_ANYXML),
            new \SoapVar('<ns1:FileBytesStream>' . $username . '</ns1:FileBytesStream>', XSD_ANYXML),
            new \SoapVar('</ns1:CreateNewDocument>', XSD_ANYXML));

        dd($this->client);
        dd($response);
    }

    protected function AddDocumentLink()
    {
        $username = 'samuser';

        $connection = 'site';

        $summary = 'this is summary';

        $category = 'some cat';

        $sub_category = 'sub';

        $document_link = 'https://www.hometelecom.co.uk';

        $response = $this->client->CreateNewDocument(new \SoapVar('<ns1:CreateNewDocument>', XSD_ANYXML),
            new \SoapVar('<ns1:IdentityToken>' . $this->getToken() . '</ns1:IdentityToken>', XSD_ANYXML),
            new \SoapVar('<ns1:Connection>' . $connection . '</ns1:Connection>', XSD_ANYXML),
            new \SoapVar('<ns1:UserName>' . $username . '</ns1:UserName>', XSD_ANYXML),
            new \SoapVar('<ns1:Summary>' . $summary . '</ns1:Summary>', XSD_ANYXML),
            new \SoapVar('<ns1:Category>' . $category . '</ns1:Category>', XSD_ANYXML),
            new \SoapVar('<ns1:SubCategory>' . $sub_category . '</ns1:SubCategory>', XSD_ANYXML),
            new \SoapVar('<ns1:DocumentLink>' . $document_link . '</ns1:DocumentLink>', XSD_ANYXML),
            new \SoapVar('</ns1:CreateNewDocument>', XSD_ANYXML));

        dd($this->client);
        dd($response);
    }
}