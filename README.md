# donteco-test

## Установка

- Стянуть репозиторий
- Запустить 'composer install'
- Запустить докер: 
> ./vendor/bin/sail up --build -d
- Применить миграции:
> docker-compose exec laravel.test php artisan migrate --seed
- Сгенерировать ключи:
> docker-compose exec laravel.test php artisan passport:keys
- Подготовить фронтенд:
> npm install && npm run dev
- Открыть сайт через "http://localhost" или "http://0.0.0.0'.

## Генерация PDF

- Перейти на `<your-host>/get-pdf`.
- Заполнить данные формы.
- Нажать "Сгенерировать справку".
- Шаблон справки можно посмотреть на `<your-host>/template-for-pdf`.

## Работа с OAuth2-сервером

### Регистрация пользователя
- Необходимо перейти на `<your-host/register>` либо нажать на кнопку `Register` в верхнем правом углу главной страницы.
- После заполнения формы произойдёт авторизация пользователя и редирект на `<your-site>/home`.

### Регистрация OAuth-клиента

1. Через сайт.
   
    - Необходимо авторизоваться и перейти на `<your-site>/home`.
    - Нажать на `Create New Client` в блоке `OAuth Clients`.
    - В появившейся форме заполнить все поля и отметить пункт `Confidentional`.
    - Нажать `Create`.
    
2. Через API.

    - Отправить запрос вида
    > POST <your-site>/oauth/clients
    
    запрос должен содержать авторизационную cookie с именем `laravel_session` и токеном доступа пользователя, а так же следующую информацию:
    > {
     "name": <client_name>,
   "redirect": <redirect_url>
   }
   
    - В случае успеха придёт ответ вида
    > {
   "user_id": <user_id>,
   "name": <client_name>,
   "secret": <client_secret>,
   "provider": null,
   "redirect": <redirect_url>,
   "personal_access_client": false,
   "password_client": false,
   "revoked": false,
   "updated_at": "2021-03-14T15:44:46.000000Z",
   "created_at": "2021-03-14T15:44:46.000000Z",
   "id": <client_id>
   }
   
### Авторизация OAuth-клиента

- Запрашивающее приложение должно сделать запрос переадресации в маршрут `<your-site>/oauth/authorize':
>Route::get('/redirect', function () {
$query = http_build_query([
'client_id' => <client_id>,
'redirect_uri' => <redirect_url>,
'response_type' => 'code',
'scope' => '',
]);
>
>return redirect('<your-site>/oauth/authorize?'.$query);
});

- Если пользователь подтвердит запрос авторизации, то будет переадресован обратно в запрашивающее приложение. Затем оно должно сделать POST-запрос в приложение, чтобы запросить токен доступа. Запрос должен содержать код авторизации, который был выдан приложением, когда пользователь подтвердил запрос авторизации.
>Route::get('/callback', function (Request $request) {
$http = new GuzzleHttp\Client;
>
>$response = $http->post('<your_site>/oauth/token', [
'form_params' => [
'grant_type' => <authorization_code>,
'client_id' => <client_id>,
'client_secret' => <client_secret>,
'redirect_uri' => <redirect_uri>,
'code' => $request->code,
],
]);
>
>return json_decode((string) $response->getBody(), true);
});
> 
> 

- Маршрут /oauth/token вернёт JSON-отклик, содержащий атрибуты access_token, refresh_token и expires_in. Атрибут expires_in содержит число секунд до истечения действия токена доступа.
- Подробнее:
  
    - https://laravel.com/docs/8.x/passport - актуальная версия (на англ.).
    - https://laravel.ru/docs/v5/passport - старая версия (на русском).

Потестировать можно тут (в поле `Scope` необходимо прописать звёздочку `*`):

- https://oauthdebugger.com/
