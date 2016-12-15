<?php
namespace ReportPE;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\CommandExecutor;
use pocketmine\event\Listener;
use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\Server;
use pocketmine\utils\TextFormat;
use pocketmine\utils\Config;
use pocketmine\permission\ServerOperator;

//Coded by CookieCode

class Main extends PluginBase implements Listener{
	
    public function onEnable(){
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->saveDefaultConfig();
        $this->getLogger()->info(TextFormat::RED . "ReportPE by Cookie loaded.");
    }
    
    public function onDisable(){
        $this->getLogger()->info(TextFormat::RED . "ReportPE disabled.");
    }
	
    public function onCommand(CommandSender $sender, Command $command, $label, array $args){
        switch($command->getName()){
			
            case "report":
		 $name = \strtolower(\array_shift($args));
                    $player = $sender->getServer()->getPlayer($name);
                if(!(isset($args[0]))){
                    $sender->sendMessage(TextFormat::RED."Usage: /report <Player> <Reason>");
                    return true;
              }
              if (!($sender instanceof Player)){ 
                $sender->sendMessage("Ã‚Â§cThis Command in only avaible In-Game");
                    return true;
                }
		if(count($args) < 1){                   
				foreach($this->getServer()->getOnlinePlayers() as $p){
					if($p->isOnline() && $p->hasPermission("report.report.view")){
						if($player instanceof Player){
					$p->sendMessage(TextFormat::DARK_RED."[Report] ".TextFormat::AQUA."Player ".$sender->getName()." reported ".TextFormat::RED.$player->getDisplayName().TextFormat::AQUA." for ".TextFormat::DARK_RED.implode("", $args));
						
						$sender->sendMessage(TextFormat::DARK_RED."[Report] ".TextFormat::AQUA."Report sended to an OP!");
						return true;
					}else{
						$sender->sendMessage(TextFormat::DARK_RED."[Report] ".TextFormat::AQUA."No OP's are online.");
						return true;
                                        }
                                        }else{ 
                                            $sender->sendMessage(TextFormat::RED."Player not online!");
					}
				}
		 	
			}else if($sender->hasPermission("chattoolspro.report")){
                             
				foreach($this->getServer()->getOnlinePlayers() as $p){
					if($p->isOnline() && $p->hasPermission("chattoolspro.report.view")){
                                            if($player instanceof Player){
							$p->sendMessage(TextFormat::DARK_RED."[Report] ".TextFormat::AQUA."Player ".$sender->getName()." reported ".TextFormat::RED.$player->getDisplayName().TextFormat::AQUA." for ".TextFormat::DARK_RED.implode("", $args));
                                                        
							$sender->sendMessage(TextFormat::DARK_RED."[Report] ".TextFormat::YELLOW."Report sended");
							return true;
					}else{
						$sender->sendMessage(TextFormat::DARK_RED."[Report] ".TextFormat::AQUA."This Player is not online! Your Report haven't been sended.");
						return true;
					}
                                        }else{ 
                                            $sender->sendMessage(TextFormat::RED."Player not online!");
					}
				}
			}else{
				$sender->sendMessage(TextFormat::RED."No Permission!");
				return true;
			}
		}
	}
}
