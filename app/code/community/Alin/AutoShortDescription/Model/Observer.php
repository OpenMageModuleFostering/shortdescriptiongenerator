<?php
class Alin_AutoShortDescription_Model_Observer {
	public function addMassaction($observer)
	{
		$block = $observer->getBlock();
		if($block instanceof Mage_Adminhtml_Block_Catalog_Product_Grid){
			$block->getMassactionBlock()->addItem('alin_autoshortdescription', array(
					'label'=> Mage::helper('catalog')->__('Generate short description'),
					'url'  => $block->getUrl('*/*/autoshortdescription')
			));
				
		}
	}
}