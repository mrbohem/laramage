# 📸 Laramage

**Laramage** is a Laravel-friendly image manipulation package built on top of [Intervention Image v3](https://image.intervention.io/). It allows you to easily read, resize, convert, and store images across different storage disks like `local`, `public`, and `s3`.

---

## ✨ Features

- ✅ Read image from `UploadedFile` or file path
- 🔧 Resize, scale, crop, and apply any Intervention method
- 🔄 Convert image formats (e.g. JPEG, PNG, WebP)
- 💾 Store image in any Laravel-supported filesystem

---

## 🧰 Requirements

- PHP 8.1+
- Laravel 9+
- [Intervention Image v3](https://image.intervention.io/v3)
- GD or Imagick extension

---

## 📦 Installation
    composer require mrbohem/laramage

---

## 🚀 Usage


    use MrBohem\Laramage\Laramage;

    Laramage::handler()
            ->load('public/images/product/main.png')
            ->convert('toWebp')
            ->apply('scale', 600, 600)
            ->store(directory: 'processed')
            ->getPath();