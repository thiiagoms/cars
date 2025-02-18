# 🚗 Car Manufactures Package

![GitHub Repo Size](https://img.shields.io/github/repo-size/sherifsheremetaj/cars)
![GitHub License](https://img.shields.io/github/license/sherifsheremetaj/cars)
![GitHub Stars](https://img.shields.io/github/stars/sherifsheremetaj/cars?style=social)
![GitHub Issues](https://img.shields.io/github/issues/sherifsheremetaj/cars)

A simple PHP package for managing **car manufacturers' data** in multiple formats (**JSON, CSV, XML**).  
Supports **data retrieval, conversion, and validation** with robust error handling.

---

## 📦 **Installation**
Install the package via Composer:

```sh
composer require sherifsheremetaj/cars
```

---

## 🚀 **Usage**
### **1️⃣ Retrieve Manufacturers**
```php
use SherifSheremetaj\Cars\Manufactures;
use SherifSheremetaj\Cars\DataType;

#JSON data
$manufactures = new Manufactures();
$data = $manufactures->getManufactures(DataType::JSON);

echo $data;

#CSV data
$manufactures = new Manufactures();
$data = $manufactures->getManufactures(DataType::CSV);

echo $data;

#XML data
$manufactures = new Manufactures();
$data = $manufactures->getManufactures(DataType::XML);

echo $data;
```

---

### **1️⃣ Retrieve CarTypes**
```php
use SherifSheremetaj\Cars\CarTypes;
use SherifSheremetaj\Cars\DataType;

#JSON data
$carTypes = new CarTypes();
$data = $carTypes->getTypes(DataType::JSON);

echo $data;

#CSV data
$carTypes = new CarTypes();
$data = $carTypes->getTypes(DataType::CSV);

echo $data;

#XML data
$carTypes = new CarTypes();
$data = $carTypes->getTypes(DataType::XML);

echo $data;
```

---

## 🛠 **Configuration**
By default, data is loaded from:
```php
__DIR__ . '/data/....';
```
---

## ✅ **Running Tests**
To run the PHPUnit test suite, use:
```sh
composer install
vendor/bin/phpunit
```

---

## 🔍 Data Source**
Logo images are crawled from Carlogos.org and processed for optimal usage.

## 📝 **Contributing**
Pull requests are welcome!  
To contribute:
1. Fork the repository.
2. Create a new feature branch (`git checkout -b feature-name`).
3. Commit your changes (`git commit -m "Added feature X"`).
4. Push to the branch (`git push origin feature-name`).
5. Open a pull request.

---

## 📜 **License**
This package is licensed under the [MIT License](LICENSE).

---

## ⭐ **Support & Feedback**
If you find this package helpful, please **⭐ star the repository**!  
For suggestions or issues, open an [issue](https://github.com/sherifsheremetaj/cars/issues).

---

Made with ❤️ by **[Sherif Sheremetaj](https://github.com/sherifsheremetaj)**
