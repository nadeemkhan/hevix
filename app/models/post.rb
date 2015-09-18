class Post < ActiveRecord::Base
  acts_as_ordered_taggable
  belongs_to :category
  
  has_attached_file :thumbnail,
                    :default_url => "/images/missing.png",
                    :url => "/thumbnails/:class-:style-:filename",
                    :path => ":rails_root/public/thumbnails/:class-:style-:filename",
                    :styles => {
                      :original => "750x350#",
                      :thumb => "230x185#"
                    }
                    
  validates_attachment_content_type :thumbnail, content_type: /\Aimage\/.*\Z/
  
  validates :title, presence: true
  validates :category_name, presence: true
  validates :tag_list, presence: true
  validates :body, presence: true
  validates :description, presence: true
end
