<?php

require ("../Model/UserModel.php");

//Contains non-database related function for the Coffee page
class UserController {

 function CreateAccount($uid, $uname, $psw, $introduction, $photo, $address, $bid, $city, $state) {
        $UserModel = new UserModel();
        $UserModel->CreateAccount($uid, $uname, $psw, $introduction, $photo, $address, $bid, $city, $state);

    }
    

/*    function CheckCustomer($bunum, $street, $apt) {
        $TrackOrderModel = new TrackOrderModel();
        $applianceArray = $TrackOrderModel->UpdateCustomer($bunum, $street, $apt);
    }
    
    function DisplayAppliance($keyword)
    {
        $TrackOrderModel = new TrackOrderModel();
        $applianceArray = $TrackOrderModel->GetApplianceConfig($keyword);
        $result = "";
        
        //Generate a coffeeTable for each coffeeEntity in array
        foreach ($applianceArray as $key => $appliance) 
        {
            $result = $result .
                    "<table class = 'orderTable'>
                       
                        <input type='checkbox' name='order[]' value=$appliance->aname;$appliance->config;$appliance->price>
                           
                        <tr>
                          <th width = '75px' >Name: </th>
                            <td>$appliance->aname</td>
                        </tr>
                        
                        <tr>
                            <th>Type: </th>
                            <td>$appliance->description</td>
                        </tr>
                        
                        <tr>
                            <th>Config: </th>
                            <td>$appliance->config</td>
                        </tr>
                        
                        <tr>
                            <th>Price: </th>
                            <td>$appliance->price</td>
                        </tr>    
                        <tr>
                            <th>Status: </th>
                            <td>$appliance->status</td>
                        </tr> 
                     </table>";
        }        
        return $result;
        
    }
    
    function DisplayOrder()
    {
        $TrackOrderModel = new TrackOrderModel();
        $orderArray = $TrackOrderModel->GetOrder();
        $result = "";
        
        //Generate a coffeeTable for each coffeeEntity in array
        foreach ($orderArray as $key => $order) 
        {
            $result = $result .
                    "<table class = 'orderTable'>   
                        <tr>
                          <th width = '75px' >OrderTime: </th>
                            <td>$order->ordertime</td>
                        </tr>
                        
                        <tr>
                            <th>Name: </th>
                            <td>$order->aname</td>
                        </tr>
                        
                        <tr>
                            <th>Config: </th>
                            <td>$order->config</td>
                        </tr>
                        
                        <tr>
                            <th>Price: </th>
                            <td>$order->price</td>
                        </tr>  
                        <tr>
                            <th>Quantity: </th>
                            <td>$order->quantity</td>
                        </tr>    
                        <tr>
                            <th>Status: </th>
                            <td>$order->status</td>
                        </tr> 
                     </table>";
        }        
        return $result;
        
    }
    
    
    function UpdateOrder($aname, $config, $price) {
        $TrackOrderModel = new TrackOrderModel();
        $TrackOrderModel->SetOrder($aname, $config, $price);
    }
*/
}
?>
