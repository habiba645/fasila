 document.addEventListener('DOMContentLoaded', () => {
        
        // 1. Select all elements that should be animated
        const elementsToAnimate = document.querySelectorAll('.animate-on-scroll');

        // 2. Set up the Intersection Observer
        //    This observer will watch our elements
        const observer = new IntersectionObserver((entries) => {
          // entries is an array of elements being watched
          
          entries.forEach(entry => {
            // entry.isIntersecting is true if the element is on screen
            if (entry.isIntersecting) {
              // Add the 'is-visible' class to trigger the CSS animation
              entry.target.classList.add('is-visible');
              
              // Optional: Stop watching the element once it's visible
              // This prevents the animation from re-running if you scroll up and down
              observer.unobserve(entry.target); 
            }
          });
        }, {
          // Optional: Adjust when the animation triggers
          // threshold: 0.1 means trigger when 10% of the element is visible
          threshold: 0.1 
        });

        // 3. Tell the observer to watch each of our selected elements
        elementsToAnimate.forEach(element => {
          observer.observe(element);
        });

      });