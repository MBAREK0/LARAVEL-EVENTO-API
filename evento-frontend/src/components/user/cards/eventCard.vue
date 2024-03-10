<template>
  <section id="card1" class="card">
    <img :src="fullImagePath()" alt="event without picture"/>
    <div class="card__content">
      <p class="card__title">{{ event.title }}</p>
      <p class="card__description">
        {{ event.description }}
      </p>
      <p class="card__description">
        {{ event.date }}
      </p>
    </div>
  </section>
</template>

<script>
export default {
    props: {
        event: {
            type: Object,
            required: true,
        },
    },
    methods:{
          fullImagePath() {
      return `http://127.0.0.1:8000/storage/${this.event.image_path}`;
    }
    }
   
};
</script>

<style scoped>
section.card {
  position: relative;
  width: 100%;
  height: 300px; /* Adjusted height */
  background-color: #111;
  border-radius: 10px;
  display: flex;
  align-items: center;
  justify-content: center;
  overflow: hidden;
  perspective: 1000px;
  transition: all 0.8s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}
.card svg {
  fill: #333;
  transition: all 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275);
  border-radius: 3px;
}
.card:hover {
  transform: scale(1.05);
  box-shadow: 0 8px 16px #000000;
  background-color: #000000;
  color: #ffffff;
}

.card__content {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  padding: 20px;
  box-sizing: border-box;
  background-color: #000;
  transform: rotateX(-90deg);
  transform-origin: bottom;
  transition: all 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275);
  border-bottom: 1px solid #ededed;
}

.card:hover .card__content {
  transform: rotateX(0deg);
}

.card__title {
  margin: 0;
  padding-left: 5px;
  font-size: 24px;
  color: var(--white);
  font-weight: 700;
}

.card:hover svg {
  scale: 0;
}

.card__description {
  margin: 10px 0 0;
  font-size: 14px;
  color: #ffffff;
  line-height: 1.4;
}
</style>
