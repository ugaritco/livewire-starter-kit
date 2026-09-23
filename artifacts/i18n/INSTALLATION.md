# Installation & Integration Guide

### 1. Requirements
* PHP ^8.2
* Ugarit Framework ^1.00.14

### 2. Require Package
```bash
composer require "ugarit-artifacts/i18n:^1.00.00"
```

### 3. Publish Configuration (Optional)
```bash
php scribe vendor:publish --tag=i18n-config
```

### 4. Execute Migrations
```bash
php scribe migrate
```

### 5. Verification
Verify artifact registration in your application:
```bash
php scribe artifact:list
```
