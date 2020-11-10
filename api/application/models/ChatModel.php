<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ChatModel extends CI_Model {

    public function getChat($idConversation,$idUser,$offset,$count){
        try{
            $this->load->database();
            $memberDetails = $this->db->query("SELECT * FROM chat_conversationmembers WHERE idUser = '$idUser' AND idConversation = $idConversation ORDER BY idMember DESC LIMIT 1")->row();
            $subQuery = "";
            if($memberDetails->deletedDate != NULL)
            $subQuery = "AND chat_chat.createdAt < '$memberDetails->deletedDate'";
            $query = $this->db->query("SELECT chat_chat.*,chat_conversationmembers.idUser FROM chat_chat JOIN chat_conversationmembers ON chat_chat.idMember = chat_conversationmembers.idMember WHERE chat_chat.idMember IN (SELECT c1.idMember FROM chat_conversationmembers as c1 WHERE c1.idConversation = $idConversation) ".$subQuery." AND (chat_chat.createdAt >= '$memberDetails->addedDate') ORDER BY chat_chat.createdAt DESC, chat_chat.idChat DESC LIMIT $count OFFSET $offset");
            return $query->result();
        }
        catch(Exception $e){
            $this->handlerex->index($e->getMessage());
        }
    }

    public function postChat($idMember,$chatText,$media,$type = 'CHAT'){
            $this->load->database();
        try{
            if($chatText != null) $chatText = addslashes($chatText);
            $qStr = "INSERT INTO chat_chat(idMember,chatText,chatType) VALUES($idMember,'$chatText','$type')";
            if($media != null)
            $qStr = "INSERT INTO chat_chat(idMember,media,chatType) VALUES($idMember,'$media','$type')";
            $query = $this->db->query($qStr);
            $idChat = $this->db->insert_id();
            $query = $this->db->query("SELECT * FROM chat_chat WHERE idChat = $idChat");
            return $query->row();
        }
        catch(Exception $e){
            $this->handlerex->index($e->getMessage());
        }   
    }

    public function getConversationById($idConversation){
            $this->load->database();
        try{
            $query = $this->db->query("SELECT * FROM chat_conversation WHERE idConversation = $idConversation");
            return $query->row();
        }
        catch(Exception $e){
            $this->handlerex->index($e->getMessage());
        }     
    }

    public function getOtherMemberInConvo($idUser,$idConversation){
            $this->load->database();
        try{
            $query = $this->db->query("SELECT * FROM chat_conversationmembers WHERE idUser != '$idUser' AND idConversation = $idConversation");
            return $query->row();
        }
        catch(Exception $e){
            $this->handlerex->index($e->getMessage());
        }
    }


    public function getConversationByUser($idUser,$idUserOther){
            $this->load->database();
        try{
            $query = $this->db->query("SELECT * FROM chat_conversation WHERE idConversation = (SELECT a.idConversation FROM chat_conversationmembers a, chat_conversationmembers b WHERE a.idUser = '$idUser' and b.idUser = '$idUserOther' and a.idConversation = b.idConversation LIMIT 1) AND chat_conversation.isGroupYN = 'N'");
            return $query->row();
        }
        catch(Exception $e){
            $this->handlerex->index($e->getMessage());
        }
    }

    public function getMemeberDetailsInConversation($idConversation){
            $this->load->database();
        try{
            $query = $this->db->query("SELECT * FROM chat_conversationmembers WHERE idConversation = $idConversation");
            return $query->result();
        }
        catch(Exception $e){
            $this->handlerex->index($e->getMessage());
        }
    }

    public function getConversationOrdered($idUser){
            $this->load->database();
        try{
        $query = $this->db->query("SELECT * FROM chat_conversation WHERE idConversation IN (SELECT idConversation FROM chat_conversationmembers WHERE idUser = '$idUser' ORDER BY lastUpdated DESC)");
        return $query->result();
        }
        catch(Exception $e){
            $this->handlerex->index($e->getMessage());
        }
    }

    public function getUnreadcount($idUser,$idConversation){
            $this->load->database();
        try{
            $query = $this->db->query("SELECT COUNT(idChat) as unreadCount FROM chat_chat WHERE idMember IN (SELECT idMember FROM chat_conversationmembers WHERE idConversation = $idConversation AND idUser != '$idUser') AND createdAt > (SELECT lastSeen FROM chat_conversationmembers WHERE idConversation = $idConversation AND idUser = '$idUser' ORDER BY idMember DESC LIMIT 1)");
            return $query->row();
        }
        catch(Exception $e){
            $this->handlerex->index($e->getMessage());
        } 
    }

    public function updateMember($isAdminYN,$deletedDate,$lastSeen,$idMember){
            $this->load->database();
        try{
            $queryStr = "UPDATE chat_conversationmembers SET lastSeen = '$lastSeen'";
            if($isAdminYN != null){
                $queryStr .= ",isAdminYN = '$isAdminYN'";
            }
            if($deletedDate != null){
                $queryStr .= ",deletedDate = '$deletedDate'";
            }
            $queryStr .= " WHERE idMember = $idMember";
            $query = $this->db->query($queryStr);
        }
        catch(Exception $e){
            $this->handlerex->index($e->getMessage());
        }
    }


    public function createConversation($convoName,$isGroupYN,$idUser){
            $this->load->database();
        try{
            $query = "INSERT INTO chat_conversation(convoName,isGroupYN,createdAt,createdBy) VALUES('$convoName','$isGroupYN',now(),'$idUser')";
            $queryStr = $this->db->query($query);
            return $this->db->insert_id();
        }
        catch(Exception $e){
            $this->handlerex->index($e->getMessage());
        }
    }

    public function updateLastUpdateconversation($idConversation){
            $this->load->database();
        try{
            $query = $this->db->query("UPDATE chat_conversation SET lastUpdated = now() WHERE idConversation = $idConversation");
        }
        catch(Exception $e){
            $this->handlerex->index($e->getMessage());
        }
    }

    public function updateConversation($idConversation,$convoName,$convoProfilePic){
            $this->load->database();
        try{
            $queryStr = "UPDATE chat_conversation SET ";
            if($convoName != null){
                $queryStr .= " convoName = '$convoName'";
                if($convoProfilePic != null) $queryStr .= ", ";
            }
            if($convoProfilePic != null){
                $queryStr .= "  convoProfilePic = '$convoProfilePic'";
            }
            $queryStr .= " WHERE idConversation = $idConversation";
            $this->db->query($queryStr);     
        }
        catch(Exception $e){
            $this->handlerex->index($e->getMessage());
        }
    }

    public function createMember($idUser,$idConversation,$isAdminYN){
            $this->load->database();
        try{
                $query = $this->db->query("INSERT INTO chat_conversationmembers(idConversation,idUser,isAdminYN,addedDate,lastSeen) VALUES($idConversation,'$idUser','$isAdminYN',now(),now())");
            return $this->db->insert_id();  
        }
        catch(Exception $e){
            $this->handlerex->index($e->getMessage());
        }
    }

    public function getMemberFromIdUser($idConversation,$idUser){
        $this->load->database();
        try{
            $query = $this->db->query("SELECT * FROM chat_conversationmembers WHERE idConversation = $idConversation AND idUser = '$idUser'");
            return $query->row();
        }
        catch(Exception $e){
            $this->handlerex->index($e->getMessage());
        }
    }

    public function getAllMembersInConversationByMember($idMember){
            $this->load->database();
        try{
            $query = $this->db->query("SELECT c1.* FROM chat_conversationmembers as c1 WHERE c1.idConversation = (SELECT c2.idConversation FROM chat_conversationmembers as c2 WHERE c2.idMember = $idMember)");
            return $query->result();
        }
        catch(Exception $e){
            $this->handlerex->index($e->getMessage());
        }
    }

    public function getMemberDetails($idMember){
        $this->load->database();
        try{
            $query = $this->db->query("SELECT * FROM chat_conversationmembers WHERE idMember = $idMember");
            return $query->row();
        }
        catch(Exception $e){
            $this->handlerex->index($e->getMessage());
        }
    }

    public function getConversationFirstChatDate($idConversation){
        $this->load->database();
        try{
            $query = $this->db->query("SELECT createdAt FROM chat_chat WHERE idMember IN (SELECT idMember FROM chat_conversationmembers WHERE idConversation = $idConversation) LIMIT 1");
            return $query->row();
        }
        catch(Exception $e){
            $this->handlerex->index($e->getMessage());
        }

    }

    public function getCommonGroups($idUser,$otherIdUser){
        $this->load->database();
        try{
            $query = $this->db->query("SELECT * FROM `chat_conversation` WHERE isGroupYN = 'Y' AND idConversation IN (SELECT DISTINCT(a.idConversation) FROM chat_conversationmembers a WHERE a.idUser = '$idUser' and a.idConversation IN (SELECT idConversation FROM chat_conversationmembers b WHERE b.idUser = '$otherIdUser'))");
            return $query->result();
        }
        catch(Exception $e){
            $this->handlerex->index($e->getMessage());
        }
    }

}