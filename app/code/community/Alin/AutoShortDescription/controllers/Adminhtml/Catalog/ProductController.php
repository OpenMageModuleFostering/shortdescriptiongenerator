<?php
class Alin_AutoShortDescription_Adminhtml_Catalog_ProductController extends Mage_Adminhtml_Controller_Action {
	public function autoshortdescriptionAction() {
		$pIds=$this->getRequest()->getParam('product');
		
		foreach ($pIds as $pId) {
			$obj = Mage::getModel('catalog/product');
			$_product=$obj->load($pId);
			$attribs=$_product->getAttributes();
			$str='<div class="gen_short"><table border="0" cellpading="2" cellspacing="2" width="100%"><tbody>';
			$i=0;
			foreach ($attribs as $attrib) {
				
				if ($attrib->getUsedInProductListing() && $attrib->getIsUserDefined()) {
					$prodAttrVal='<b>'.$attrib->getStoreLabel().': </b>';
					$pa=$_product->getAttributeText($attrib->getAttributeCode());
					if ($pa==null) $pa='N/A';
					$prodAttrVal.=$pa;
					if ($i % 2==0) $str.='<tr><td>'.$prodAttrVal.'</td>';
					else $str.='<td>'.$prodAttrVal.'</td></tr>';
					$i++;
				}

			}
			if ($i % 2!=0) $str.='</tr>';
			$str.='</tbody></table></div>';
			$_product->setShortDescription($str);
			$obj->save();
		}
		Mage::dispatchEvent('catalog_product_massupdate_after', array('products'=>$pIds));
		$this->_redirect('adminhtml/catalog_product/index/', array());
	}
}
