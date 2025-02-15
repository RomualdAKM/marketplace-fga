<template>
    <div class="container col-lg-12 mt-4">
      <div class="product_details_tab_content tab-content">
        <!-- Other tabs content -->
        <h1 class="mt-2">Commentaires</h1>
        <!-- Start Single Content -->
        <div class="product_tab_content tab-pane active" id="reviews" role="tabpanel">
          <div class="review_address_inner mt-30" v-if="reviews">
            <!-- Start Single Review -->
            <div v-for="review in reviews" :key="review.id" class="pro_review">
              <div class="review_thumb">
                <img alt="review images" src="/assets/images/others/reviewer.png">
              </div>
              <div class="review_details">
                <div class="review_info mb-10">
                  <div class="single-product-item-rating">
                    <i v-for="star in 5" :key="star" class="icon-rt-star-solid" :class="{'select-star': star <= review.rating}"></i>
                  </div>
                  <h5><span class="user-name">{{ review.username }}</span> - <span class="comment-date">{{ review.created_at }}</span></h5>
                </div>
                <p class="reviewer-text">{{ review.comment }}</p>
              </div>
            </div>
            <!-- End Single Review -->
  
            <!-- Start Rating Area -->
            <div class="rating_wrap mt-2">
              <h5 class="rating-title-1">Laissez un commentaire</h5>
              <p>Votre adresse e-mail ne sera pas publiée. Les champs marqués d'un * sont obligatoires</p>
             
              <div class="rating_list d-flex gap-2 align-items-center">
                <h6 class="rating-title-2">Votre évaluation</h6>
                <!-- <p class="text-muted">Cliquez sur une etoile pour laisser votre evaluation</p> -->
                <div class="review_info mt-1">
                  <div class="single-product-item-rating mb-0">
                    <i v-for="star in 5" :key="star" class="icon-rt-star-solid" :class="{'select-star': star <= newReview.rating}" @click="setRating(star)"></i>
                  </div>
                </div>
              </div>
            </div>
            <!-- End Rating Area -->
  
            <!-- Start Comment Area -->
            <div class="comments-area comments-reply-area">
              <div class="row">
                <div class="col-lg-12">
                  <form @submit.prevent="submitReview" class="comment-form-area">
                    <div class="row comment-input">
                      <div class="col-md-6 comment-form-author mt-3">
                        <label>Nom complet <span class="required">*</span></label>
                        <input type="text" v-model="newReview.username" required>
                      </div>
                      <div class="col-md-6 comment-form-email mt-3">
                        <label>Email <span class="required">*</span></label>
                        <input type="email" v-model="newReview.email" required>
                      </div>
                    </div>
                    <div class="comment-form-comment mt-3">
                      <label>Commentaire</label>
                      <textarea v-model="newReview.comment" required></textarea>
                    </div>
                    <!-- <div class="comment-form-submit mt-3">
                      <button type="submit" class="comment-submit">Submit</button>
                    </div> -->
                    <div class="comment-form-submit mt-3">
                                                        <input type="submit" value="Envoyer" class="comment-submit">
                                                    </div>
                  </form>
                </div>
              </div>
            </div>
            <!-- End Comment Area -->
          </div>
        </div>
        <!-- End Single Content -->
      </div>
    </div>
  </template>
  
  <script setup>
  import { ref,onMounted } from 'vue';

  const productId = defineProps({
    productId: { type: Number, required: true },
  })
  
  const reviews = ref({});
  
  const newReview = ref({
    product_id: productId,
    username: '',
    email: '',
    rating: 0,
    comment: ''
  });

  const setRating = (rating) => {
    newReview.value.rating = rating;
  };
  
  const getReviews = async () => {
    const response = await axios.get('/api/get_reviews/'+ productId['productId']);
    reviews.value = response.data
    console.log('reviews',response.data)
}


  
  const submitReview = async () => {
    try {
     
      const response = await axios.post("/api/store_review", newReview.value);
      if (response.data.success) {
        toast.fire({
          icon: "success",
          title: "Ajouté avec succès",
        });
       
        newReview.value.username = '';
        newReview.value.email = '';
        newReview.value.rating = 0;
        newReview.value.comment = '';
         window.location.reload();
          
        } else {
       
            console.log('error',response.data.message);
            toast.fire({
                icon: "error",
                title: "Veuillez remplir tous les champs requis",
            });
        }
    } catch (error) {
      console.error('Error submitting review:', error);
    }
  };
  onMounted (async() => {
    console.log('productId',productId['productId'])

  await  getReviews()
})
  </script>
  
  <style scoped>
  .select-star {
    color: gold;
  }
  </style>
  