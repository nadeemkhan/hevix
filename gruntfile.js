module.exports = function(grunt) {

  grunt.initConfig({

    pkg: grunt.file.readJSON('package.json'),

    watch: {
        all: {
          files: ['*.less'],
          tasks: ['less'],
          options: {
            livereload: 1337
          }
        }
    },

    ftpush: {
        build: {
          auth: {
            host: 'toropanov.com',
            port: 21,
            authKey: 'toropanov'
          },
          src: '',
          dest: '',
          exclusions: ['.ftppath', 'node_modules', '.git', '.grunt'],
          simple: true
        }
      },

    git_deploy: {
      bitbucket: {
        options: {
          url: 'git@bitbucket.org:tanotify/toropanov.com.git',
          branch: 'master',
          message: 'Local changing in <%= grunt.template.today("dd/mm/yyyy") %>'
        },
        src: '.'
      },
    }

  });

  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-ftpush');
  grunt.loadNpmTasks('grunt-git-deploy');

  grunt.registerTask('default', ['ftpush']);
  grunt.registerTask('push', ['ftpush', 'git_deploy']);
};