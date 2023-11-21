<?php
/* ====================
[BEGIN_COT_EXT]
Hooks=global
Order=20
[END_COT_EXT]
==================== */

/**
 * Menu Generator for Cotonti CMF
 *
 * @author esclkm, http://www.littledev.ru, Kalnov Alexey <kalnovalexey@yandex.ru>
 * @copyright (c) esclkm http://www.littledev.ru, Lily Software https://lily-software.com (ex. Portal30 Studio)
 */
defined('COT_CODE') or die('Wrong URL.');

function cot_read_sqltable()
{
	global $db, $db_menugenerator, $mg_menuarray, $local_max, $mg_set;
	$sql = $db->query("SELECT * FROM $db_menugenerator ORDER BY mg_path ASC");
	while ($row = $sql->fetch())
	{
		if (mb_strpos($row['mg_path'], ".") === false)
			$mg_set[] = $row['mg_path'];

		$parent = mb_substr($row['mg_path'], 0, mb_strrpos($row['mg_path'], "."));
		$parent = ($parent == '') ? 'GENERAL' : $parent;
		$mg_menuarray[$parent][$row['mg_id']] = $row;
		$local_max = ($row['mg_id'] > $local_max) ? $row['mg_id'] : $local_max;
	}
	$mg_set = array_unique($mg_set);
	$local_max += 1;
}

function cot_build_menugenerator($parent = '', $usergr = 4, $level = 0, $menutree='general')
{
	global $cfg, $mg_menuarray, $cot_extrafields, $db_menugenerator;
	$sskin = cot_tplfile('menugenerator.'.mb_strtolower($menutree).'.level'.$level.'.'.$parent, 'plug');
	$menugeneratort = new XTemplate($sskin);
	$level++;
	$parent = ($parent == '') ? 'GENERAL' : $parent;

	foreach ($mg_menuarray[$parent] as $key => $row)
	{
        $jj = 0;
		if (empty($row['mg_users']) || !in_array($usergr, explode(', ', $row['mg_users'])))
		{
			$jj++;
			$submenugenerator = '';
			if (isset($mg_menuarray[$row['mg_path']]))
			{
				$submenugenerator = cot_build_menugenerator($row['mg_path'], $usergr, $level, $menutree);
			}
            // parse_url
            $tmp = parse_url($row['mg_href']);
            if (empty($tmp['host']) && empty($tmp['scheme']) && !empty($tmp['path']) && mb_strpos($tmp['path'], '.php') !== false) {
                $query = array();
                $anchor = !empty($tmp['fragment']) ? $tmp['fragment'] : '';
                if (!empty($tmp['query'])) parse_str($tmp['query'], $query);
                if ($tmp['path'] == "index.php"){
                    if (isset($query['e'])){
                        $name = $query['e'];
                        unset($query['e']);
                        $row['mg_href'] = cot_url($name, $query, $anchor);
                    }else{
                        $row['mg_href'] = cot_url('index', $query, $anchor);
                    }

                }elseif(preg_match("/^[\/]?([A-Za-z]{1,30}).php/i", $tmp['path'], $matches)){
                    $name = $matches[1];
                    $row['mg_href'] = cot_url($name, $query, $anchor);
                }

            }
//			$xhref = explode(".php?", $row['mg_href'], 2);
//			if(count($xhref) == 2 && preg_match("([a-zA-Z]{1,30})", $xhref[0]))
//			{
//				$row['mg_href'] = cot_url($xhref[0], $xhref[1]);
//			}
//			var_dump($row);
			$menugeneratort->assign(array(
				'MENU_TITLE' => htmlspecialchars($row['mg_title']),
				'MENU_HREF' => $row['mg_href'],
                'MENU_PATH' => $row['mg_path'],
				'MENU_EXTRA' => htmlspecialchars($row['mg_extra']),
				'MENU_DESC' => htmlspecialchars($row['mg_desc']),
				'MENU_ID' => htmlspecialchars($row['mg_id']),
				'MENU_SUBMENU' => $submenugenerator,
				'MENU_ODDEVEN' => cot_build_oddeven($jj),
				'MENU_JJ' => $jj
			));
			
			foreach ($cot_extrafields[$db_menugenerator] as $rowex)
			{
				$menugeneratort->assign(array(
					'MENU_'.mb_strtoupper($rowex['field_name']).'_TITLE' => isset($L['menugenerator_'.$rowex['field_name'].'_title']) ?  $L['menugenerator_'.$rowex['field_name'].'_title'] : $rowex['field_description'],
					'MENU_'.mb_strtoupper($rowex['field_name']) => cot_build_extrafields_data('menugenerator', $rowex, $row["mg_{$rowex['field_name']}"])
				));
			}
			
			$menugeneratort->parse('MENU.ITEM');
		}
	}
	$menugeneratort->assign('MENU_LEVEL', $level);
	$menugeneratort->parse('MENU');
	return $menugeneratort->text('MENU');
}

$db_menugenerator = $db_x.'menugenerator';
$cot_extrafields[$db_menugenerator] = (!empty($cot_extrafields[$db_menugenerator]))	? $cot_extrafields[$db_menugenerator] : array();

// МЕНЮ ГЕНИРИРУЕТСЯ СРАЗУ ПРИ ЗАПУСКЕ СТРАНИЦЫ.
// делал микулик
//создаем меню.
// запускаем генератор
// Читаем всписки менюшек.

if (!isset($mg_menus))
{
	$mg_menus = array();
}

if (!isset($mg_menus[$usr['maingrp']]))
{
	$local_max = 0;
	$mg_set[] = 'GENERAL';
	$mg_menuarray = array();
	cot_read_sqltable();
	foreach ($mg_set as $key => $val)
	{
		if (isset($mg_menuarray[$val]))
		{
			$mg_menus[$usr['maingrp']][mb_strtoupper(trim($val))] = cot_build_menugenerator(trim($val), $usr['maingrp'], 0, $val);
		}
	}
	$cache && $cache->db->store('mg_menus', $mg_menus, 'system', 7200);
}
$MENUGENERATOR = isset($mg_menus[$usr['maingrp']]) ? $mg_menus[$usr['maingrp']] : null;
