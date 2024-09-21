<?php

/**
 * The MIT License
 * Copyright (c) 2007 Andy Smith.
 */

declare(strict_types=1);

namespace Limepie\TwitterOAuth;

/**
 * A class for implementing a Signature Method
 * See section 9 ("Signing Requests") in the spec.
 */
abstract class SignatureMethod
{
    /**
     * Needs to return the name of the Signature Method (ie HMAC-SHA1).
     *
     * @return string
     */
    abstract public function getName();

    /**
     * Build up the signature
     * NOTE: The output of this function MUST NOT be urlencoded.
     * the encoding is handled in OAuthRequest when the final
     * request is serialized.
     *
     * @return string
     */
    abstract public function buildSignature(
        Request $request,
        Consumer $consumer,
        ?Token $token = null,
    );

    /**
     * Verifies that a given signature is correct.
     */
    public function checkSignature(
        Request $request,
        Consumer $consumer,
        Token $token,
        string $signature,
    ) : bool {
        $built = $this->buildSignature($request, $consumer, $token);

        // Check for zero length, although unlikely here
        if (0 == \strlen($built) || 0 == \strlen($signature)) {
            return false;
        }

        if (\strlen($built) != \strlen($signature)) {
            return false;
        }

        // Avoid a timing leak with a (hopefully) time insensitive compare
        $result = 0;

        for ($i = 0; $i < \strlen($signature); ++$i) {
            $result |= \ord($built[$i]) ^ \ord($signature[$i]);
        }

        return 0 == $result;
    }
}
