<script setup>
import {ref,onMounted}  from 'vue'

const props = defineProps({
    productId: Number
})


const addWishlist = async () => {
  
    await axios.post("/api/add_wishlist",
        {
            productId:  props.productId
        }
    ).then((response) => {
        if (response.data.success) {
         
           //window.location.reload();
            toast.fire({
                icon: "success",
                title: "Ajouté avec succès",
            });
          
        } else {
        
            console.log('error',response.data.message);
            toast.fire({
                icon: "error",
                title: "Veuillez vous authentifier",
            });
        }
    }).catch((error) => {
      
        console.error('Error saving course:', error);
        toast.fire({
            icon: "error",
            title: "Veuillez vous authentifier.",
        });
    });
}
console.log('productId passed to WishlistButton component:', props.productId)

</script>

<template>

     <button type="button" @click="addWishlist()" class="single-product-item-action-link" tabindex="0"><i class="icon-rt-heart2"></i></button>
    
</template>