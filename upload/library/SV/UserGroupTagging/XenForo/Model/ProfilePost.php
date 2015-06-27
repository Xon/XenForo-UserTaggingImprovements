<?php

class SV_UserGroupTagging_XenForo_Model_ProfilePost extends XFCP_SV_UserGroupTagging_XenForo_Model_ProfilePost
{
    public function alertTaggedMembers(
        array $profilePost, array $profileUser, array $tagged, array $alreadyAlerted = array(),
        $isComment = false, array $taggingUser = null
    )
    {
		if (!$taggingUser)
		{
			$taggingUser = $profilePost;
		}

        $userTaggingModel = $this->_getUserTaggingModel();
        $tagged = $userTaggingModel->expandTaggedGroups($tagged, $taggingUser);
        $alertedUsers = parent::alertTaggedMembers($profilePost, $profileUser, $tagged, $alreadyAlerted, $isComment, $taggingUser);
        $userTaggingModel->emailAlertedUsers($alertedUsers, $taggingUser);
        return $alertedUsers;
    }

    protected function _getUserTaggingModel()
    {
        return $this->getModelFromCache('XenForo_Model_UserTagging');
    }
}