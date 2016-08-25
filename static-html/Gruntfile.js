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
          'js/vendor/foundation/foundation.core.js': 'bower_components/foundation-sites/js/foundation.core.js',
          'js/vendor/foundation/foundation.offcanvas.js': 'bower_components/foundation-sites/js/foundation.offcanvas.js',
          'js/vendor/foundation/foundation.util.mediaQuery.js': 'bower_components/foundation-sites/js/foundation.util.mediaQuery.js',
          'js/vendor/foundation/foundation.util.triggers.js': 'bower_components/foundation-sites/js/foundation.util.triggers.js',
          'js/vendor/foundation/foundation.util.motion.js': 'bower_components/foundation-sites/js/foundation.util.motion.js'
          // other components goes here
          // 'bower_components/foundation-sites/js/
        }
      }
    },

    uglify: {
      options: {
        sourceMap: true
      },
      vendor: {
        files: {
          'js/vendor.min.js': [
            'bower_components/jquery/dist/jquery.min.js',
            'js/vendor/jquery-ui.min.js',
            'js/vendor/jquery.selectBoxIt.min.js',
            'js/vendor/foundation/*.js'
          ]
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
      partialsDev: {
        src: '<%= fixturesPath %>/partials-dev/*.html',
        dest: '<%= fixturesPath %>/partials/',
        options: {
          beautify: true,
          sections: {
            blocks: {
              socialList: '<%= fixturesPath %>/blocks/social-list.html',
              promoBox: '<%= fixturesPath %>/blocks/promo-box.html',
              postsList: '<%= fixturesPath %>/blocks/posts-list.html',
              gridItemBlog: '<%= fixturesPath %>/blocks/grid-item-blog.html',
              gridItemBloglanding: '<%= fixturesPath %>/blocks/grid-item-blogLanding.html',
              gridItemArtist: '<%= fixturesPath %>/blocks/grid-item-artist.html',
              gridItemEvent: '<%= fixturesPath %>/blocks/grid-item-event.html',
              gridItemVenue: '<%= fixturesPath %>/blocks/grid-item-venue.html',
              pagination: '<%= fixturesPath %>/blocks/pagination.html',
              swipeboxItem: '<%= fixturesPath %>/blocks/swipebox-item.html',
              homeHeaderSection: '<%= fixturesPath %>/blocks/header-section.html',
              entityPagination: '<%= fixturesPath %>/blocks/entity-pagination.html',
              search: '<%= fixturesPath %>/blocks/search.html',
              searchItem: '<%= fixturesPath %>/blocks/search-item.html'
            }
          }
        }
      },
      dist: {
        src: '<%= fixturesPath %>/pages/*.html',
        dest: '',
        options: {
          beautify: true,
          sections: {
            services: {
              head: '<%= fixturesPath %>/services/head.html',
              scripts: '<%= fixturesPath %>/services/scripts.html'
            },
            partials: {
              footer: '<%= fixturesPath %>/partials/footer.html',
              header: '<%= fixturesPath %>/partials/header.html',
              homeHeader: '<%= fixturesPath %>/partials/home-header.html',
              offCanvas: '<%= fixturesPath %>/partials/off-canvas.html',
              sidebarTemplate: '<%= fixturesPath %>/partials/sidebar-template.html',
              blogPost: '<%= fixturesPath %>/partials/blog-post-template.html',
              testTemplate: '<%= fixturesPath %>/partials/testpage-template.html',
              sectionLanding: '<%= fixturesPath %>/partials/section-landing.html',
              blogLanding: '<%= fixturesPath %>/partials/blog-landing-template.html',
              blogCategory: '<%= fixturesPath %>/partials/blog-category-template.html',
              directoryTemplate: '<%= fixturesPath %>/partials/directory-template.html',
              contactTemplate: '<%= fixturesPath %>/partials/contact-template.html',
              artistPageLayout: '<%= fixturesPath %>/partials/artist-page-template.html',
              eventPageLayout: '<%= fixturesPath %>/partials/event-page-template.html',
              venuePageLayout: '<%= fixturesPath %>/partials/venue-page-template.html',
              eventListTemplate: '<%= fixturesPath %>/partials/event-list-template.html',
              venueListTemplate: '<%= fixturesPath %>/partials/venue-list-template.html',
              indexPageLayout: '<%= fixturesPath %>/partials/index-page-template.html',
              searchPage: '<%= fixturesPath %>/partials/search-page-template.html'
            }
          }
        }
      }
    },

    watch: {
      sass: {
        files: 'scss/**/*.scss',
        tasks: ['sass', 'postcss', 'copy:styles']
      },
      jsVendor: {
        files: 'js/vendor/**/*.js',
        tasks: ['babel', 'uglify:vendor', 'copy:js']
      },
      jsCustom: {
        files: 'js/custom/**/*.js',
        tasks: ['uglify:custom', 'copy:js']
      },
      svg: {
        files: 'images/svgs/*.svg',
        tasks: ['svgstore', 'svginjector', 'copy:media']
      },
      favicons: {
        files: 'favicons/*',
        tasks: ['copy:media']
      },
      system: {
        files: ['Gruntfile.js', 'package.json', 'bower.json'],
        tasks: ['copy:system']
      },
      markup: {
        files: 'dev-html/**/*.html',
        tasks: ['htmlbuild:partialsDev', 'htmlbuild:dist']
      }
    },

    copy: {
      options: {
        expand: true
      },
      styles: {
        files: [
          {
            src: [
              'css/**',
              'scss/**'
            ],
            dest: '../wp-content/themes/w4ptheme/'
          }
        ]
      },
      js: {
        files: [
          {
            src: [
              'js/**'
            ],
            dest: '../wp-content/themes/w4ptheme/'
          }
        ]
      },
      media: {
        files: [
          {
            src: [
              'images/**',
              'favicons/**'
            ],
            dest: '../wp-content/themes/w4ptheme/'
          }
        ]
      },
      system: {
        files: [
          {
            src: [
              'Gruntfile.js',
              'package.json',
              'bower.json'
            ],
            dest: '../wp-content/themes/w4ptheme/'
          }
        ]
      },
      build: {
        files: [
          {
            expand: true,
            src: [
              'css/**',
              'js/**',
              'images/**',
              'favicons/**',
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
