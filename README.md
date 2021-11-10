# エンジニア相談App

## 設計書

https://docs.google.com/spreadsheets/d/1sApnnnyDDyOA4j_rF3ROKEGo5Ro-AXdlQvV2XLD911g/edit#gid=0

## 環境構築

* Clone & Sail Up

```
$ git clone git@github.com:kbanchi-spartacamp/engineer-connect-app.git
$ cd engineer-connect-app
$ git switch develop
$ docker run --rm \
  -v $(pwd):/opt \
  -w /opt \
  laravelsail/php80-composer:latest \
  bash -c "composer install"
$ cp .env.example .env
$ sail up -d
$ sail artisan key:generate
$ sail artisan migrate:fresh --seed
```

* GCPのcredential

credential.jsonをengineer-connect-app/配下に配置してください
