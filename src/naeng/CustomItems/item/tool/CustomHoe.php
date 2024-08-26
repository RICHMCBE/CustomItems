<?php

namespace naeng\CustomItems\item\tool;

use customiesdevs\customies\item\CreativeInventoryInfo;
use customiesdevs\customies\item\ItemComponents;
use customiesdevs\customies\item\ItemComponentsTrait;
use naeng\CustomItems\CustomItems;
use naeng\CustomItems\trait\CustomItemTrait;
use pocketmine\block\BlockToolType;
use pocketmine\item\Hoe;
use pocketmine\item\ItemIdentifier;
use pocketmine\item\ToolTier;

class CustomHoe extends Hoe implements ItemComponents{

    use CustomItemTrait;
    use ItemComponentsTrait;

    public function __construct(ItemIdentifier $identifier, string $name = "Unknown"){
        parent::__construct($identifier, $name, ToolTier::NETHERITE());
        $info = CustomItems::getInstance()->getInfo($this->getTypeId());
        $this->initComponent($info["texture"], new CreativeInventoryInfo(CreativeInventoryInfo::CATEGORY_EQUIPMENT, CreativeInventoryInfo::GROUP_HOE));
        if(isset($info["render_offsets"])) {
            $this->setupRenderOffsets(($info["render_offsets"]["width"] ?? 16), ($info["render_offsets"]["height"] ?? 16), ($info["render_offsets"]["hand_equipped"] ?? false));
        }
        $this->addComponent(...$this->init($info));
    }

    public function getBlockToolType() : int{
        return BlockToolType::HOE;
    }

}