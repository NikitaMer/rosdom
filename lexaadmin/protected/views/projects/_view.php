<?php
/* @var $this ProjectsController */
/* @var $data Projects */
?>

<div class="view" style="width:200px; height:170px; display:inline-block;">

	<?php echo CHtml::link(
		CHtml::image(
			'http://www.rosdom.ru/projects/'.CHtml::encode(strtolower($data->id)).'/p-sm.jpg', 
			'123',
			array('width'=>200, 'height'=>150)
		), 
		array('view', 'id'=>$data->id)
	); ?>
	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<? /*

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('konkurents')); ?>:</b>
	<?php echo CHtml::encode($data->konkurents); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('des')); ?>:</b>
	<?php echo CHtml::encode($data->des); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('book')); ?>:</b>
	<?php echo CHtml::encode($data->book); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mas_des')); ?>:</b>
	<?php echo CHtml::encode($data->mas_des); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cd_des')); ?>:</b>
	<?php echo CHtml::encode($data->cd_des); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('o_pl')); ?>:</b>
	<?php echo CHtml::encode($data->o_pl); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('g_pl')); ?>:</b>
	<?php echo CHtml::encode($data->g_pl); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mater')); ?>:</b>
	<?php echo CHtml::encode($data->mater); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('prev')); ?>:</b>
	<?php echo CHtml::encode($data->prev); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pl_z')); ?>:</b>
	<?php echo CHtml::encode($data->pl_z); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('add_info')); ?>:</b>
	<?php echo CHtml::encode($data->add_info); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('important')); ?>:</b>
	<?php echo CHtml::encode($data->important); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('o2c')); ?>:</b>
	<?php echo CHtml::encode($data->o2c); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_new')); ?>:</b>
	<?php echo CHtml::encode($data->is_new); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fs')); ?>:</b>
	<?php echo CHtml::encode($data->fs); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('v')); ?>:</b>
	<?php echo CHtml::encode($data->v); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('h')); ?>:</b>
	<?php echo CHtml::encode($data->h); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sflag')); ?>:</b>
	<?php echo CHtml::encode($data->sflag); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cd')); ?>:</b>
	<?php echo CHtml::encode($data->cd); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dt')); ?>:</b>
	<?php echo CHtml::encode($data->dt); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pr0')); ?>:</b>
	<?php echo CHtml::encode($data->pr0); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pr1')); ?>:</b>
	<?php echo CHtml::encode($data->pr1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pr2')); ?>:</b>
	<?php echo CHtml::encode($data->pr2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pr3')); ?>:</b>
	<?php echo CHtml::encode($data->pr3); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pr4')); ?>:</b>
	<?php echo CHtml::encode($data->pr4); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pr0_cd')); ?>:</b>
	<?php echo CHtml::encode($data->pr0_cd); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pr1_cd')); ?>:</b>
	<?php echo CHtml::encode($data->pr1_cd); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pr2_cd')); ?>:</b>
	<?php echo CHtml::encode($data->pr2_cd); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pr3_cd')); ?>:</b>
	<?php echo CHtml::encode($data->pr3_cd); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pr4_cd')); ?>:</b>
	<?php echo CHtml::encode($data->pr4_cd); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pr0_arch')); ?>:</b>
	<?php echo CHtml::encode($data->pr0_arch); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pr1_arch')); ?>:</b>
	<?php echo CHtml::encode($data->pr1_arch); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pr2_arch')); ?>:</b>
	<?php echo CHtml::encode($data->pr2_arch); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pr3_arch')); ?>:</b>
	<?php echo CHtml::encode($data->pr3_arch); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pr4_arch')); ?>:</b>
	<?php echo CHtml::encode($data->pr4_arch); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('arch')); ?>:</b>
	<?php echo CHtml::encode($data->arch); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('forum')); ?>:</b>
	<?php echo CHtml::encode($data->forum); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('archname')); ?>:</b>
	<?php echo CHtml::encode($data->archname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dillername')); ?>:</b>
	<?php echo CHtml::encode($data->dillername); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('request')); ?>:</b>
	<?php echo CHtml::encode($data->request); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mas_request')); ?>:</b>
	<?php echo CHtml::encode($data->mas_request); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cd_request')); ?>:</b>
	<?php echo CHtml::encode($data->cd_request); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cz_request')); ?>:</b>
	<?php echo CHtml::encode($data->cz_request); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pk_request')); ?>:</b>
	<?php echo CHtml::encode($data->pk_request); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cz_des')); ?>:</b>
	<?php echo CHtml::encode($data->cz_des); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('pk_des')); ?>:</b>
	<?php echo CHtml::encode($data->pk_des); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('flores')); ?>:</b>
	<?php echo CHtml::encode($data->flores); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('site')); ?>:</b>
	<?php echo CHtml::encode($data->site); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('konkurents2')); ?>:</b>
	<?php echo CHtml::encode($data->konkurents2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('masterov_links')); ?>:</b>
	<?php echo CHtml::encode($data->masterov_links); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lastedit')); ?>:</b>
	<?php echo CHtml::encode($data->lastedit); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lastcomment')); ?>:</b>
	<?php echo CHtml::encode($data->lastcomment); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('mas_lastcomment')); ?>:</b>
	<?php echo CHtml::encode($data->mas_lastcomment); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cd_lastcomment')); ?>:</b>
	<?php echo CHtml::encode($data->cd_lastcomment); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('archlink')); ?>:</b>
	<?php echo CHtml::encode($data->archlink); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('comments_count')); ?>:</b>
	<?php echo CHtml::encode($data->comments_count); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sver')); ?>:</b>
	<?php echo CHtml::encode($data->sver); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sverdate')); ?>:</b>
	<?php echo CHtml::encode($data->sverdate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('score')); ?>:</b>
	<?php echo CHtml::encode($data->score); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('creator')); ?>:</b>
	<?php echo CHtml::encode($data->creator); ?>
	<br />
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('rosdom_title')); ?>:</b>
	<?php echo CHtml::encode($data->rosdom_title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rosdom_h1')); ?>:</b>
	<?php echo CHtml::encode($data->rosdom_h1); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rosdom_des')); ?>:</b>
	<?php echo CHtml::encode($data->rosdom_des); ?>
	<br />
	
	*/ ?>

</div>