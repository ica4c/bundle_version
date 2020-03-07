<?php

use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;
use Solid\VersionChecker\Clients\GooglePlay\Exceptions\FailedToResolveGooglePlayVersionException;
use Solid\VersionChecker\Clients\GooglePlay\GooglePlayVersionResolver;

class GooglePlayVersionResolverTest extends TestCase
{
    /** @var \Solid\VersionChecker\Clients\GooglePlay\GooglePlayVersionResolver */
    protected $resolver;

    /**
     * AppStoreResolverTest constructor.
     */
    public function __construct()
    {
        parent::__construct('App store resolver');
        $this->resolver = new GooglePlayVersionResolver(new Client);
    }

    /**
     * @throws \Solid\VersionChecker\Clients\GooglePlay\Exceptions\FailedToResolveGooglePlayVersionException
     */
    public function testResponse()
    {
        $bundle = 'org.pixelrush.moneyiq';
        $version = $this->resolver->resolve($bundle);

        $this->assertSame($bundle, $version->getBundleId());
        $this->assertIsString($version->getCurrentRevision());
    }

    /**
     * @throws \Solid\VersionChecker\Clients\GooglePlay\Exceptions\FailedToResolveGooglePlayVersionException
     */
    public function testFails()
    {
        $this->expectException(FailedToResolveGooglePlayVersionException::class);
        $this->resolver->resolve('gibberish');
    }
}
