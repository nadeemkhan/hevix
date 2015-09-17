class CreatePosts < ActiveRecord::Migration
  def change
    create_table :posts do |t|
      t.string :title
      t.string :author
      t.string :css_class
      t.string :category_name
      t.text :description
      t.text :body
      t.text :referral_url
      t.text :vk_post_refer
      t.text :fb_post_refer
      t.text :twitter_post_refer
      t.integer :likes_count
      t.integer :comments_count
      t.boolean :is_visible

      t.timestamps null: false
    end
  end
end
