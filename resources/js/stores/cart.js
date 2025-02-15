import { defineStore } from 'pinia';

export const useCartStore = defineStore('cart', {
  state: () => ({
    items: JSON.parse(localStorage.getItem('cartItems')) || [],
    discount: 0, // Pourcentage de remise appliqué
  }),
  actions: {
    addToCart(product, quantity, selectedOptions) {
      const existingItem = this.items.find(item =>
        item.product.id === product.id &&
        JSON.stringify(item.selectedOptions) === JSON.stringify(selectedOptions)
      );

      if (existingItem) {
        existingItem.quantity += quantity;
      } else {
        const item = {
          product,
          quantity,
          selectedOptions,
        };
        this.items.push(item);
      }

      this.saveCartItems(); 
      this.updateTotalPrice();

      toast.fire({
        icon: "success",
        title: "Ajouté avec succès",
      });
    },

    removeFromCart(product, selectedOptions) {
      this.items = this.items.filter(item =>
        item.product.id !== product.id ||
        JSON.stringify(item.selectedOptions) !== JSON.stringify(selectedOptions)
      );
      this.saveCartItems(); 
      this.updateTotalPrice();
    },

    increaseQuantity(product, selectedOptions) {
      const item = this.items.find(item =>
        item.product.id === product.id &&
        JSON.stringify(item.selectedOptions) === JSON.stringify(selectedOptions)
      );
      if (item) {
        item.quantity++;
        this.saveCartItems(); 
        this.updateTotalPrice();
      }
    },

    decreaseQuantity(product, selectedOptions) {
      const item = this.items.find(item =>
        item.product.id === product.id &&
        JSON.stringify(item.selectedOptions) === JSON.stringify(selectedOptions)
      );
      if (item && item.quantity > 1) {
        item.quantity--;
        this.saveCartItems(); 
        this.updateTotalPrice();
      }
    },

    clearCart() {
      this.items = [];
      this.saveCartItems(); 
      this.updateTotalPrice();
    },

    getTotalPrice() {
      const total = this.items.reduce((total, item) => {
        const optionsTotal = item.selectedOptions.reduce((sum, option) => sum + option.additional_price, 0);
        return total + ((item.product.base_price + optionsTotal) * item.quantity);
      }, 0);
      
      return (total * (1 - this.discount / 100));
    },

    applyPromo(promo) {
      this.discount = promo.percentage;
      this.saveCartItems();
      this.updateTotalPrice();
      localStorage.setItem('appliedPromoCode', promo.code);
    },

    removePromo() {
      this.discount = 0;
      this.updateTotalPrice();
      localStorage.removeItem('appliedPromoCode');
    },

    updateTotalPrice() {
      // Pas besoin de faire quoi que ce soit ici car getTotalPrice s'occupera du calcul
    },

    saveCartItems() {
      localStorage.setItem('cartItems', JSON.stringify(this.items));
    }
  }
});
