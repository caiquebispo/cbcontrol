const Networks = {

    init: function(){
        
        Networks.list()
        Networks.events_listeners()
    },
    events_listeners: function(){

        $('#create-new-network').on('click', function(e){
            e.preventDefault();

            Networks.get_modal_create_new_network()
        })
    },
    list: function(){
        axios({
            
            method: 'GET',
            url:  `${window.location.href}/list`,

        }).then((response) =>{
            
            Networks.drawning_table_networks(response.data)

        }).catch((error) => {
            
            console.log('errors', error.response.data)
        })
    },
    drawning_table_networks: function(networks){
        
        $('.content-table-networks').html()
        $('.content-table-networks').html('<table class="table table-networks"></table>')

        console.log('networks', networks)
    },
    get_modal_create_new_network: function(){

        console.log('crete')
    },
}