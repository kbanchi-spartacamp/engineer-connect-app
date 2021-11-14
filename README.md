# エンジニア相談App

## 設計書

https://docs.google.com/spreadsheets/d/1sApnnnyDDyOA4j_rF3ROKEGo5Ro-AXdlQvV2XLD911g/edit#gid=0

## プレゼンテーション

* beatiful ai

https://www.beautiful.ai/player/-Mo8HOIMT-libUBNeq4e

* prott

https://prottapp.com/p/eef3b3

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

## DBリフレッシュ

```
sail artisan migrate:fresh
sail artisan db:seed
sail artisan db:seed --class SkillCategorySeeder
sail artisan db:seed --class MentorSkillSeeder
sail artisan db:seed --class MentorScheduleSeeder
sail artisan db:seed --class ReservationSeeder
sail artisan db:seed --class BookmarkSeeder
sail artisan db:seed --class MessageSeeder
sail artisan db:seed --class ReviewSeeder
```
