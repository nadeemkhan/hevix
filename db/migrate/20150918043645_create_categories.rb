class CreateCategories < ActiveRecord::Migration
  def change
    create_table :categories do |t|
      t.string  :title
      t.string  :url_name
      t.text    :description
      t.integer :count
      
      t.timestamps null: false
    end
  end
end
