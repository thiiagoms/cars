# 🚗 Manufactures Package

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
### **1️⃣ Retrieve Manufacturers in JSON**
```php
use SherifSheremetaj\Cars\Manufactures;
use SherifSheremetaj\Cars\DataType;

$manufactures = new Manufactures();
$data = $manufactures->getManufactures(DataType::JSON);

echo $data; // Returns JSON string
```

---

### **2️⃣ Retrieve Manufacturers in CSV**
```php
$data = $manufactures->getManufactures(DataType::CSV);

echo $data;
/*
Expected Output:
id,name
1,Toyota
2,Ford
*/
```

---

### **3️⃣ Retrieve Manufacturers in XML**
```php
$data = $manufactures->getManufactures(DataType::XML);

echo $data;
/*
Expected Output:
<manufacturers>
    <manufacturer>
        <id>1</id>
        <name>Toyota</name>
    </manufacturer>
    <manufacturer>
        <id>2</id>
        <name>Ford</name>
    </manufacturer>
</manufacturers>
*/
```

---

## ⚙ **Methods**
| Method | Description |
|--------|-------------|
| `getManufactures(string $type)` | Retrieves manufacturers' data in **JSON, CSV, or XML** formats. |
| `loadManufacturesJson()` | Loads manufacturers from a JSON file. |
| `loadManufacturesCsv()` | Converts JSON data into CSV format. |
| `loadManufacturesXml()` | Converts JSON data into XML format. |

---

## 🛠 **Configuration**
By default, data is loaded from:
```php
__DIR__ . '/data/manufactures.json';
```
You can modify `datasetPath()` to use a **custom data source**.

---

## ✅ **Running Tests**
To run the PHPUnit test suite, use:
```sh
composer install
vendor/bin/phpunit
```

---

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
