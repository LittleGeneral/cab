<?php

namespace PetstoreIO;

class CabController
{
    /**
     * @SWG\Get(path="/cab/{cab}",
     *   tags={"cab"},
     *   summary="获取",
     *   description="",
     *   operationId="getUserByName",
     *   produces={"application/xml", "application/json"},
     *   @SWG\Parameter(
     *     name="cab",
     *     in="path",
     *     description="The name that needs to be fetched. Use user1 for testing. ",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Response(response=200, description="successful operation", @SWG\Schema(ref="#/definitions/User")),
     *   @SWG\Response(response=400, description="Invalid cab supplied"),
     *   @SWG\Response(response=404, description="User not found")
     * )
     */
    public function getUserByName($cab)
    {
    }


    /**
     * @SWG\Delete(path="/cab/{cab}",
     *   tags={"cab"},
     *   summary="Delete user",
     *   description="This can only be done by the logged in user.",
     *   operationId="deleteUser",
     *   produces={"application/xml", "application/json"},
     *   @SWG\Parameter(
     *     name="cab",
     *     in="path",
     *     description="The name that needs to be deleted",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Response(response=400, description="Invalid cab supplied"),
     *   @SWG\Response(response=404, description="User not found")
     * )
     */
    public function deleteUser()
    {
    }
}
