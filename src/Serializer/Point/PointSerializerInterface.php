<?php
declare(strict_types=1);

namespace ricco381\Ecc\Serializer\Point;

use ricco381\Ecc\Primitives\PointInterface;
use ricco381\Ecc\Primitives\CurveFpInterface;

interface PointSerializerInterface
{
    /**
     *
     * @param  PointInterface $point
     * @return string
     */
    public function serialize(PointInterface $point): string;

    /**
     * @param  CurveFpInterface $curve  Curve that contains the serialized point
     * @param  string           $string
     * @return PointInterface
     */
    public function unserialize(CurveFpInterface $curve, string $string): PointInterface;
}
