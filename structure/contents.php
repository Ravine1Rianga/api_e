
<?php
class contents{
    public function main_content(){
        ?>
        <div>
            <h1>Main Content<h1>
<p>A SLAAC host may use the following Duplicate Address Detection (DAD) process to 
ensure that the IPv6 GUA is unique. • The host sends an ICMPv6 Neighbor Solicitation (NS) message with a specially 
constructed solicited-node multicast address containing the last 24 bits of IPv6 
address of the host. • If no other devices respond with a Neighbor Advertisement (NA) message, then the 
address is virtually guaranteed to be unique and can be used by the host. • If an NA is received by the host, then the address is not unique, and the host must 
generate a new interface ID to use </p>
    </div>
    <?php
    }
    public function side_bar(){
        ?>
        <div>
            <h1>Sidebar<h1>
    </div>
    <?php
    }
}
