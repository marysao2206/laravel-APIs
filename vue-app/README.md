# Vue + Laravel Frontend

This folder is a standalone Vue 3 app that consumes the Laravel API in this repo.

## Local setup

1. Start Laravel:
```bash
php artisan serve
```

2. Start Vue:
```bash
cd vue-app
npm install
npm run dev
```

The Vue app reads:
- `GET /api/student`
- `GET /api/products`

## Environment

If you deploy Vue and Laravel on different domains, set:
```bash
VITE_API_BASE_URL=https://your-laravel-domain.com/api
```

For local development, the Vite proxy already forwards `/api` to Laravel.

## Production build

```bash
cd vue-app
npm run build
```

The production files will be created in `dist/`.
