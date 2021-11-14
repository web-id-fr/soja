<?php

return [
    'driver' => null,
    'jws' => [
        'algorithms' => [
            \Jose\Component\Signature\Algorithm\HS256::class,
            \Jose\Component\Signature\Algorithm\HS384::class,
            \Jose\Component\Signature\Algorithm\HS512::class,
            \Jose\Component\Signature\Algorithm\ES256::class,
            \Jose\Component\Signature\Algorithm\ES384::class,
            \Jose\Component\Signature\Algorithm\ES512::class,
            \Jose\Component\Signature\Algorithm\RS256::class,
            \Jose\Component\Signature\Algorithm\RS384::class,
            \Jose\Component\Signature\Algorithm\RS512::class,
            \Jose\Component\Signature\Algorithm\PS256::class,
            \Jose\Component\Signature\Algorithm\PS384::class,
            \Jose\Component\Signature\Algorithm\PS512::class,
            \Jose\Component\Signature\Algorithm\EdDSA::class,
            \Jose\Component\Signature\Algorithm\None::class,
        ],
        'serializers' => [
            \Jose\Component\Signature\Serializer\CompactSerializer::class,
            \Jose\Component\Signature\Serializer\JSONFlattenedSerializer::class,
            \Jose\Component\Signature\Serializer\JSONGeneralSerializer::class,
        ],
    ],
    'jwe' => [
        'algorithms' => [
            'key' => [
                \Jose\Component\Encryption\Algorithm\KeyEncryption\A128KW::class,
                \Jose\Component\Encryption\Algorithm\KeyEncryption\A192KW::class,
                \Jose\Component\Encryption\Algorithm\KeyEncryption\A256KW::class,
                \Jose\Component\Encryption\Algorithm\KeyEncryption\A128GCMKW::class,
                \Jose\Component\Encryption\Algorithm\KeyEncryption\A192GCMKW::class,
                \Jose\Component\Encryption\Algorithm\KeyEncryption\A256GCMKW::class,
                \Jose\Component\Encryption\Algorithm\KeyEncryption\Dir::class,
                \Jose\Component\Encryption\Algorithm\KeyEncryption\ECDHES::class,
                \Jose\Component\Encryption\Algorithm\KeyEncryption\ECDHESA128KW::class,
                \Jose\Component\Encryption\Algorithm\KeyEncryption\ECDHESA192KW::class,
                \Jose\Component\Encryption\Algorithm\KeyEncryption\ECDHESA256KW::class,
                \Jose\Component\Encryption\Algorithm\KeyEncryption\PBES2HS256A128KW::class,
                \Jose\Component\Encryption\Algorithm\KeyEncryption\PBES2HS384A192KW::class,
                \Jose\Component\Encryption\Algorithm\KeyEncryption\PBES2HS512A256KW::class,
                \Jose\Component\Encryption\Algorithm\KeyEncryption\RSA15::class,
                \Jose\Component\Encryption\Algorithm\KeyEncryption\RSAOAEP::class,
                \Jose\Component\Encryption\Algorithm\KeyEncryption\RSAOAEP256::class
            ],
            'content' => [
                \Jose\Component\Encryption\Algorithm\ContentEncryption\A128GCM::class,
                \Jose\Component\Encryption\Algorithm\ContentEncryption\A192GCM::class,
                \Jose\Component\Encryption\Algorithm\ContentEncryption\A256GCM::class,
                \Jose\Component\Encryption\Algorithm\ContentEncryption\A128CBCHS256::class,
                \Jose\Component\Encryption\Algorithm\ContentEncryption\A192CBCHS384::class,
                \Jose\Component\Encryption\Algorithm\ContentEncryption\A256CBCHS512::class
            ]
        ]
    ],
];
