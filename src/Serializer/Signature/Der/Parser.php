<?php
declare(strict_types=1);

namespace ricco381\Ecc\Serializer\Signature\Der;

use FGR\ASN1\ASNObject;
use FGR\ASN1\Identifier;
use FGR\ASN1\Universal\Integer;
use ricco381\Ecc\Crypto\Signature\Signature;
use ricco381\Ecc\Crypto\Signature\SignatureInterface;
use ricco381\Ecc\Exception\SignatureDecodeException;

class Parser
{
    /**
     * @param string $binary
     * @return SignatureInterface
     * @throws \FGR\ASN1\Exception\ParserException
     */
    public function parse(string $binary): SignatureInterface
    {
        $offsetIndex = 0;
        $asnObject = ASNObject::fromBinary($binary, $offsetIndex);

        if ($offsetIndex != strlen($binary)) {
            throw new SignatureDecodeException('Invalid data.');
        }

        // Set inherits from Sequence, so use getType!
        if ($asnObject->getType() !== Identifier::SEQUENCE) {
            throw new SignatureDecodeException('Invalid tag for sequence.');
        }

        if ($asnObject->getNumberofChildren() !== 2) {
            throw new SignatureDecodeException('Invalid data.');
        }

        if (!($asnObject[0] instanceof Integer && $asnObject[1] instanceof Integer)) {
            throw new SignatureDecodeException('Invalid data.');
        }

        return new Signature(
            gmp_init($asnObject[0]->getContent(), 10),
            gmp_init($asnObject[1]->getContent(), 10)
        );
    }
}
