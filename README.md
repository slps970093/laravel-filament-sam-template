## 多國語言

### 切換語系教學

在 blade 以 ajax 送到後端，若 ajax 回應 204 刷新前端頁面即可完成
請注意，這是 POST 請求 需設定 X-CSRF-TOKEN

```html
<!doctype html>
<html>
    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>simple page</title>
        <meta charset="utf-8" />
    </head>
    <body>
        系統目前語言 {{ app()->getLocale() }}
    </body>
    <script type="text/javascript">
        function switchLanguage() {
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            
            let formData = new FormData();

            // 切換語系放這邊 zh_TW => 繁體中文 , en => 英文
            formData.append('language', 'zh_TW');
            
            fetch('{{ route("ajax.switch.language") }}', {
                method: 'POST', // 指定请求方法为 POST
                headers: {
                    'X-CSRF-TOKEN': csrfToken, // 包含 CSRF 令牌
                },
                body: formData, // 发送的数据
            })
                    .then((response) => {
                        alert('切換成功')
                        window.location.reload();
                    })
                    .catch(error => console.error('Error:', error));
        }
    </script>
</html>
```

app()->getLocale() 原則上吃 .env APP_LOCALE
只要在 routes/web.php 設定好以下即可

```php
// 切換語系 middleware
Route::middleware('switch-lang')->group(function () {
    // 要切換語系的 path 放這邊
});
```

## 管理員設定

在終端機輸入以下指令，系統會快速建立

```bash
php artisan filament:create-employee 
```

若顯示 "設定完畢！可以登入後台了" 那就直接去以下網址輸入帳號密碼即可
http://你的網址/admin/login
