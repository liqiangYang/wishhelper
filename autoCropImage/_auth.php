<?php
/**
 * autoCropImage - ͼƬ�Զ����ų���
 * 
 * @link https://github.com/mingfunwong/autoCropImage
 * @license http://opensource.org/licenses/MIT
 * @author Mingfun Wong <mingfun.wong.chn@gmail.com>
 */
 
// �������ṩ�Ͽ���߼�����ֹ�������ɴ����ļ�
// ���жϱ����� $width $height $mode $versions

// ���ӣ�
if ($width > 10000 OR $height > 10000) $autoCropImage->show_not_found();
