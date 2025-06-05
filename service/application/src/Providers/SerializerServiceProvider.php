<?php
namespace Application\Providers;

use Concrete\Core\Foundation\Service\Provider;
use Doctrine\Common\Annotations\AnnotationReader;
use Symfony\Component\Serializer\Encoder\CsvEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\YamlEncoder;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Loader\AnnotationLoader;
use Symfony\Component\Serializer\NameConverter\MetadataAwareNameConverter;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\JsonSerializableNormalizer;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;

class SerializerServiceProvider extends Provider
{
    public function register(): void
    {
        $this->app->singleton(SerializerInterface::class, function () {
            $classMetadataFactory = new ClassMetadataFactory(new AnnotationLoader(new AnnotationReader()));
            $encoders = [
                new CsvEncoder(),
                new JsonEncoder(),
                new XmlEncoder(),
                new YamlEncoder(),
            ];
            $meta = new MetadataAwareNameConverter($classMetadataFactory);

            $normalizers = [
                new ArrayDenormalizer(),
                new DateTimeNormalizer(),
                new ObjectNormalizer($classMetadataFactory, $meta),
            ];
            return new Serializer($normalizers, $encoders);
        });

        $this->app->singleton(NormalizerInterface::class, function () {
            $classMetadataFactory = new ClassMetadataFactory(new AnnotationLoader(new AnnotationReader()));
            $encoders = [
                new CsvEncoder(),
                new JsonEncoder(),
                new XmlEncoder(),
                new YamlEncoder(),
            ];

            $meta = new MetadataAwareNameConverter($classMetadataFactory);

            $normalizers = [
                new ArrayDenormalizer(),
                new DateTimeNormalizer(),
                new ObjectNormalizer($classMetadataFactory, $meta),
                new JsonSerializableNormalizer(),
            ];
            return new Serializer($normalizers, $encoders);
        });

        $this->app->singleton(Serializer::class, function () {
            $classMetadataFactory = new ClassMetadataFactory(new AnnotationLoader(new AnnotationReader()));
            $encoders = [
                new CsvEncoder(),
                new JsonEncoder(),
                new XmlEncoder(),
                new YamlEncoder(),
            ];
            $meta = new MetadataAwareNameConverter($classMetadataFactory);
            $normalizers = [
                new ArrayDenormalizer(),
                new DateTimeNormalizer(),
                new ObjectNormalizer($classMetadataFactory, $meta),
                new JsonSerializableNormalizer(),
            ];
            return new Serializer($normalizers, $encoders);
        });
    }
}
