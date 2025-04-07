your-image-processor/
├── src/
│   ├── Contracts/
│   │   ├── ImageProcessorInterface.php
│   │   ├── StorageInterface.php
│   │   ├── ImageConversionInterface.php
│   │   ├── ImageCompressionInterface.php
│   ├── Processors/
│   │   ├── ImagickImageProcessor.php
│   │   ├── GdImageProcessor.php
│   ├── Conversions/
│   │   ├── WebpConverter.php
│   │   ├── JpegConverter.php
│   │   ├── PngConverter.php
│   ├── Compression/
│   │   ├── LossyCompressor.php
│   │   ├── LosslessCompressor.php
│   ├── Storage/
│   │   ├── AwsS3Storage.php
│   │   ├── LocalStorage.php
│   │   ├── AzureBlobStorage.php
│   ├── ImageProcessorManager.php
│   ├── ImageProcessorService.php
│   ├── ImageProcessor.php
├── config/
│   └── image-processor.php
├── composer.json
├── README.md