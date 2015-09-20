Rails.application.routes.draw do
  resources :posts
  devise_for :users
  
  root 'posts#index'
  
  get 'tags/:tag',          to: 'posts#index', as: :tag
  get 'category/:category', to: 'posts#index', as: :category
  get 'about',              to: 'posts#index'
end
