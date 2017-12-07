# База данных

Структура базы данных представлена на изображении ниже. Разработка структуры велась в datamodeller от Oracle. Файлы сохранены в папке dataBase для возможности изменения схемы.
![](/dataBase/db_struct.png)

## Небольшое описание:

В таблице <b>types_of_days</b> подразумевается хранение двух типов дней:
- день, описывающий план на продолжительный период (например, всю следующую неделю подряд будние дни будут одинаковыми). В таком случае в поле <b>d_date</b> таблицы <b>days</b> будет храниться дата старта периода. Подразумевается, что для нахождения конца периода необходимо найти начало следующего;
- день, описывающий план на одну конкретную дату (допустим завтра надо сходить к врачу, и весь план на день изменится, но послезавтра график возвращается в привычное русло). В таком случае в поле <b>d_date</b> таблицы <b>days</b> будет храниться конкретная дата.


Таблица <b>action_types</b> хранит в себе типизацию действий:
- разработка,
- домашняя работа,
- сон,
- отдых,
- и т.д.

Т.к. разработка планируется многоплатформенная (web, android, tizen), цвета, для отображения того или иного действия, хранятся в поле <b>color</b>