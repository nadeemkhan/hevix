class PostsController < ApplicationController
  before_action :authenticate_user!, except: [:index, :show]
  
  def index
    if params[:tag]
      @posts      = Post.tagged_with(params[:tag]).order('created_at DESC')
      @page_title = 'All posts tagges with ' + params[:tag]
    elsif params[:category]
      @posts      = Post.where(category_name: params[:category]).order('created_at DESC')
      @page_title = Category.where(url_name: params[:category])[0].title
    else
      @posts      = Post.all.order('created_at DESC')
      @page_title = 'Latest posts'
    end
    
    if @posts.length == 0
      render 'error_404'
    end
  end
  
  def new
    @post = Post.new
  end
  
  def create
    @post = Post.new(post_params)
    
    if @post.save
      redirect_to @post
    else
      render 'new'
    end
  end
  
  def show
    @post = Post.find(params[:id])
  end
  
  def edit
    @post = Post.find(params[:id])
  end
  
  def update
    @post = Post.find(params[:id])
    
    if @post.update(params[:post].permit(:title, :thumbnail, :body, :description, :tag_list, :category_name))
      redirect_to @post
    else
      render 'edit'
    end
  end
  
  def destroy
    @post = Post.find(params[:id])
    @post.destroy
    
    redirect_to root_path
  end
  
  private
    def post_params
      params.require(:post).permit(:title, :thumbnail, :body, :description, :tag_list, :category_name)
    end
end
