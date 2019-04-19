<?php

declare(strict_types=1);

namespace ricco381\Ecc\Serializer\Signature;

use ricco381\Ecc\Crypto\Signature\SignatureInterface;

interface DerSignatureSerializerInterface
{
    /**
     * @param SignatureInterface $signature
     * @return string
     */
    public function serialize(SignatureInterface $signature): string;

    /**
     * @param string $binary
     * @return SignatureInterface
     * @throws \FGR\ASN1\Exception\ParserException
     */
    public function parse(string $binary): SignatureInterface;
}
