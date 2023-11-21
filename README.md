# cot-menu-generate
Remade  Menu Generator

Menu Generator
============
Расширения / Администрирование и управление / Menu Generator

Часто, выполняя заказ на создание веб-сайта, мы сталкиваемся с необходимостью предоставить Заказчику возможность комфортного и простого в понимании инструмента для наполнения и редактирования многоуровневого главного меню. Непосредственная работа с шаблоном по FTP или через онлайновый редактор сложна и чревата ошибками в разметке. Именно поэтому мы разработали и создали плагин Menu Generator, который позволяет неопытному пользователю манипулировать главным меню без знаний HTML и без опасности нанести серьезный вред сайту.

 

Авторы: esclkm, Kalnov Alexey, Cotonti Team

Github: https://github.com/Cotonti-Extensions/menugenerator
1. Установка

    Распаковать в папку plugins на вашем сервере
    Установить плагин в панели администратора
    Заполнить меню в панели администратора → Расширения → Menu Generator → Администрирование
    Добавить теги в шаблоны темы

Настройка меню в панели администратора:

2. Теги

Теги для вывода меню в шаблонах имеют следующий формат:
1
	
{PHP.MENUGENERATOR.<PATH>}

Например из скриншота выше нижнее меню в "подвале" (footer.tpl):
1
	
{PHP.MENUGENERATOR.F}

А боковое меню сайта (в header.tpl):
1
	
{PHP.MENUGENERATOR.LE}

Все теги глобальные и доступны из любого шаблона.
3. Шаблоны

Меню можно кастомизировать при помощи шаблонов. Имена шаблонов формируются по следующему принципу:
1
	
menugenerator.<general_or_path_root>.<level>.<path>.tpl

где:

    general_or_path_root (необязательно) - это 'general' или корневой элемент.
    level (необязательно) - уровень вложенности: level0, level1 и т.д.
    path (необязательно) - путь

Например:

для скриншота выше шаблон меню в "подвале" сайта будет в файле menugenerator.t.tpl, а шаблон бокового меню menugenerator.le.tpl, шаблон меню первого уровня: menugenerator.le.level1.tpl

Можно оформить отдельный пункт меню так: menugenerator.le.level2.le.1.30.tpl
4. Дополнительные поля

Вы можете использовать дополнительные поля для вывода дополнительной информации (описания), иконок и т.п. Поддерживаютя и экстраполя.
5. Теги в шаблонах меню

    {MENU_TITLE} - заголовок меню
    {MENU_HREF} - ссылка
    {MENU_PATH} - путь (см. заполнение меню)
    {MENU_EXTRA} - дополнительное поле
    {MENU_DESC} - описание
    {MENU_ID} - ID
    {MENU_SUBMENU} - вложенное меню.


Plugin for [CMF Cotonti](https://www.cotonti.com) that enables main menu management by an unexperienced user without 
endangering the html-layout.

Authors: [esclkm](https://www.cotonti.com/users/esclkm), Kalnov Alexey <kalnovalexey@yandex.ru>, Cotonti Team

Plugin page:  
https://www.cotonti.com/extensions/administration-management/menu-generator

## Installation
- Unpack to your plugins folder
- Install the plugin in Administration panel
- Fill out the menu using the tools section: Administration panel → Extensions → Menu Generator → Administration
- Place tags in the templates

Menu edit example:
![menu-generator](https://github.com/Cotonti-Extensions/menugenerator/assets/1021886/b4efed59-57d1-485c-ae0e-b41938147c14)

## Tags

Tags for displaying menus in theme templates have the following format:
```	
{PHP.MENUGENERATOR.<PATH>}
```
For example, from the screenshot above, the bottom menu in the "footer" (footer.tpl)
```
{PHP.MENUGENERATOR.F}
```
And the side menu (in header.tpl):
```	
{PHP.MENUGENERATOR.LE}
```
All tags are global and accessible from any template.

## Templates

The menu can be customized using templates. Template names are formed according to the following principle:
```	
menugenerator.<general_or_path_root>.<level>.<path>.tpl
```
where:
- **general_or_path_root** (optional) - is word 'general' or root element.
- **level** (optional) - nesting level: level0, level1, etc.
- **path** (optional) - path

For example:

for the screenshot above, the menu template in the "footer" of the site will be in the `menugenerator.t.tpl`, and the side menu template is `menugenerator.le.tpl`, the first level menu template: `menugenerator.le.level1.tpl`

Single menu item can be designed in template: `menugenerator.le.level2.le.1.30.tpl`

## Additional (extra) fields

You can use additional fields to display additional information: description, icons, etc. Extrafields are also supported.

## Tags in menu templates

`{MENU_TITLE}` - menu item title  
`{MENU_HREF}` - link  
`{MENU_PATH}` - path (see menu filling)  
`{MENU_EXTRA}` - additional text field  
`{MENU_DESC}` - description  
`{MENU_ID}` - ID  
`{MENU_SUBMENU}` - submenu.
