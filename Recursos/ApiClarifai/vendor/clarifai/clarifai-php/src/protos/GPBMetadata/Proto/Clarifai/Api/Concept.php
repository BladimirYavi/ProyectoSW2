<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: proto/clarifai/api/concept.proto

namespace GPBMetadata\Proto\Clarifai\Api;

class Concept
{
    public static $is_initialized = false;

    public static function initOnce() {
        $pool = \Google\Protobuf\Internal\DescriptorPool::getGeneratedPool();

        if (static::$is_initialized == true) {
          return;
        }
        \GPBMetadata\Proto\Clarifai\Api\Common::initOnce();
        \GPBMetadata\Proto\Clarifai\Api\Status\Status::initOnce();
        \GPBMetadata\Proto\Clarifai\Api\Utils\Extensions::initOnce();
        \GPBMetadata\Proto\Clarifai\Utils\Pagination\Pagination::initOnce();
        \GPBMetadata\Google\Protobuf\Timestamp::initOnce();
        $pool->internalAddGeneratedFile(hex2bin(
            "0ab50d0a2070726f746f2f636c6172696661692f6170692f636f6e636570" .
            "742e70726f746f120c636c6172696661692e6170691a2670726f746f2f63" .
            "6c6172696661692f6170692f7374617475732f7374617475732e70726f74" .
            "6f1a2970726f746f2f636c6172696661692f6170692f7574696c732f6578" .
            "74656e73696f6e732e70726f746f1a3070726f746f2f636c617269666169" .
            "2f7574696c732f706167696e6174696f6e2f706167696e6174696f6e2e70" .
            "726f746f1a1f676f6f676c652f70726f746f6275662f74696d657374616d" .
            "702e70726f746f22a5010a07436f6e63657074120a0a0269641801200128" .
            "09120c0a046e616d65180220012809121a0a0576616c7565180320012802" .
            "420bd5b5180000803f80b51801122e0a0a637265617465645f6174180420" .
            "01280b321a2e676f6f676c652e70726f746f6275662e54696d657374616d" .
            "7012100a086c616e6775616765180520012809120e0a066170705f696418" .
            "062001280912120a0a646566696e6974696f6e18072001280922640a0c43" .
            "6f6e63657074436f756e74120a0a026964180120012809120c0a046e616d" .
            "65180220012809123a0a12636f6e636570745f747970655f636f756e7418" .
            "032001280b321e2e636c6172696661692e6170692e436f6e636570745479" .
            "7065436f756e7422360a10436f6e6365707454797065436f756e7412100a" .
            "08706f73697469766518012001280d12100a086e65676174697665180220" .
            "01280d22580a11476574436f6e6365707452657175657374122f0a0b7573" .
            "65725f6170705f696418012001280b321a2e636c6172696661692e617069" .
            "2e55736572417070494453657412120a0a636f6e636570745f6964180220" .
            "01280922660a134c697374436f6e636570747352657175657374122f0a0b" .
            "757365725f6170705f696418012001280b321a2e636c6172696661692e61" .
            "70692e557365724170704944536574120c0a047061676518022001280d12" .
            "100a087065725f7061676518032001280d22af010a1b506f7374436f6e63" .
            "65707473536561726368657352657175657374122f0a0b757365725f6170" .
            "705f696418012001280b321a2e636c6172696661692e6170692e55736572" .
            "417070494453657412310a0d636f6e636570745f71756572791802200128" .
            "0b321a2e636c6172696661692e6170692e436f6e63657074517565727912" .
            "2c0a0a706167696e6174696f6e18032001280b32182e636c617269666169" .
            "2e6170692e506167696e6174696f6e222e0a0c436f6e6365707451756572" .
            "79120c0a046e616d6518012001280912100a086c616e6775616765180220" .
            "012809226f0a13506f7374436f6e636570747352657175657374122f0a0b" .
            "757365725f6170705f696418012001280b321a2e636c6172696661692e61" .
            "70692e55736572417070494453657412270a08636f6e6365707473180220" .
            "03280b32152e636c6172696661692e6170692e436f6e636570742280010a" .
            "145061746368436f6e636570747352657175657374122f0a0b757365725f" .
            "6170705f696418012001280b321a2e636c6172696661692e6170692e5573" .
            "6572417070494453657412270a08636f6e636570747318022003280b3215" .
            "2e636c6172696661692e6170692e436f6e63657074120e0a06616374696f" .
            "6e180320012809226a0a17476574436f6e63657074436f756e7473526571" .
            "75657374122f0a0b757365725f6170705f696418012001280b321a2e636c" .
            "6172696661692e6170692e557365724170704944536574120c0a04706167" .
            "6518022001280d12100a087065725f7061676518032001280d226c0a1553" .
            "696e676c65436f6e63657074526573706f6e7365122b0a06737461747573" .
            "18012001280b321b2e636c6172696661692e6170692e7374617475732e53" .
            "746174757312260a07636f6e6365707418022001280b32152e636c617269" .
            "6661692e6170692e436f6e6365707422720a144d756c7469436f6e636570" .
            "74526573706f6e7365122b0a0673746174757318012001280b321b2e636c" .
            "6172696661692e6170692e7374617475732e537461747573122d0a08636f" .
            "6e636570747318022003280b32152e636c6172696661692e6170692e436f" .
            "6e63657074420480b518012282010a194d756c7469436f6e63657074436f" .
            "756e74526573706f6e7365122b0a0673746174757318012001280b321b2e" .
            "636c6172696661692e6170692e7374617475732e53746174757312380a0e" .
            "636f6e636570745f636f756e747318022003280b321a2e636c6172696661" .
            "692e6170692e436f6e63657074436f756e74420480b5180142245a036170" .
            "69a2020443414950c202015fca0211436c6172696661695c496e7465726e" .
            "616c620670726f746f33"
        ));

        static::$is_initialized = true;
    }
}
