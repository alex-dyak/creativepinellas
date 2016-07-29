module.exports = function (grunt) {

  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),

    sass: {
      options: {
        outputStyle: 'compressed',
        sourceMap: true
      },
      all: {
        options: {
          includePaths: [
            'bower_components/foundation-sites/scss',
            'bower_components/motion-ui/'
          ]
        },
        files: {
          'css/application.css': 'scss/application.scss'
        }
      }
    },

    postcss: {
      options: {
        map: true,
        processors: [
          require('autoprefixer-core')({
            browsers: ['> 0.5%', 'last 2 versions', 'Firefox ESR', 'Opera 12.1', 'ie >6']
          })
        ]
      },
      all: {
        src: 'css/*.css'
      }
    },

    /**
     *  foundation needs to go first through Babel, because foundation uses ES6
     *  in array add all needed foundation libs
     *  */
    babel: {
      options: {
        presets: ['es2015']
      },
      vendor: {
        files: {
          'js/vendor/foundation.js': [
            'bower_components/jquery/dist/jquery.min.js',
            'bower_components/foundation-sites/js/foundation.core.js'
            // other components goes here
            // 'bower_components/foundation-sites/js/
          ]
        }
      }
    },

    uglify: {
      options: {
        sourceMap: true
      },
      vendor: {
        files: {
          'js/vendor.min.js': ['js/vendor/foundation.js']
        }
      },
      custom: {
        files: {
          'js/app.min.js': [
            'js/custom/svgdefs.js',
            'js/custom/app.js'
          ]
        }
      }
    },

    imagemin: {
      all: {
        files: [{
          expand: true,
          cwd: 'images/',
          src: ['**/*.{png,jpg,gif}'],
          dest: 'images/'
        }]
      }
    },

    svgstore: {
      options: {
        cleanupdefs: true
      },
      default: {
        files: {
          'images/defs.svg': ['images/svgs/*.svg']
        }
      }
    },

    svginjector: {
      svgdefs: {
        options: {
          container: '#svgPlaceholder'
        },
        files: {
          'js/custom/svgdefs.js': 'images/defs.svg'
        }
      }
    },

    fixturesPath: 'dev-html',
    htmlbuild: {
      dist: {
        src: '<%= fixturesPath %>/pages/*.html',
        dest: '',
        options: {
          sections: {
            services: {
              head: '<%= fixturesPath %>/services/head.html',
              scripts: '<%= fixturesPath %>/services/scripts.html'
            },
            partials: {
              header: '<%= fixturesPath %>/partials/header.html'
            }
          }
        }
      }
    },

    watch: {
      sass: {
        files: 'scss/**/*.scss',
        tasks: ['sass', 'postcss']
      },
      jsVendor: {
        files: 'js/vendor/**/*.js',
        tasks: ['babel', 'uglify:vendor']
      },
      jsCustom: {
        files: 'js/custom/**/*.js',
        tasks: ['uglify:custom']
      },
      sprite: {
        files: 'images/icons/*.png',
        tasks: ['sprite', 'sass']
      },
      markup: {
        files: 'dev-html/**/*.html',
        tasks: ['htmlbuild']
      }
    },

    copy: {
      build: {
        files: [
          {
            expand: true,
            src: [
              'css/**',
              'js/**',
              'images/**',
              'fonts/**',
              'scss/**',
              'Gruntfile.js',
              'package.json',
              'bower.json'
            ],
            dest: '../wp-content/themes/w4ptheme/'
          }
        ]
      }
    }
  });

  grunt.loadNpmTasks('grunt-sass');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-postcss');
  grunt.loadNpmTasks('grunt-contrib-imagemin');
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-babel');
  grunt.loadNpmTasks('grunt-svgstore');
  grunt.loadNpmTasks('grunt-svginjector');
  grunt.loadNpmTasks('grunt-contrib-copy');
  grunt.loadNpmTasks('grunt-html-build');

  grunt.registerTask('default', ['sass', 'postcss', 'imagemin', 'svgstore', 'svginjector', 'babel', 'uglify']);

  // task 'wpbuild' for copy all needed files to wp theme.
  grunt.registerTask('wpbuild', ['copy:build']);

};